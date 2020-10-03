<?php

namespace App\Models;

use App\Models\AdminModel;
use DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
class UserModel extends AdminModel
{
    public function __construct() {
        $this->table = 'user';
        $this->folderUpload = 'user';
        $this->fieldSearchAccepted = ['id','username','email','fullname'];
        $this->crudNotAccepted = ['_token','avatar_current','password_confirmation','task'];
    }
    public function listItems($params = null,$options = null) {
        $result = null;
            if($options['task'] == 'admin-list-items') {
                $query = $this->select('id','username','email','fullname','level','avatar','created','created_by','modified','modified_by','status');
            
            if($params['filter']['status'] != 'all') {
                $query->where('status','=',$params['filter']['status']);
            }
            if($params['search']['value'] != '') {
                if($params['search']['field'] == 'all') {
                    $query->where(function($query) use ($params) {
                        foreach ($this->fieldSearchAccepted as $key => $value) {
                            $query->orWhere($value,'LIKE',"%{$params['search']['value']}%");
                        }
                    });
                } else if(in_array($params['search']['field'],$this->fieldSearchAccepted)){
                    $query->where($params['search']['field'],'LIKE',"%{$params['search']['value']}%");
                }
            }
            $result = $query->orderBy('id','desc')->paginate($params['pagination']['totalItemsPerPage']);  
        }
        if($options['task'] == 'news-list-items') {
            $query = $this->select('id','username','email','fullname','avatar','level','created','created_by','modified','modified_by','status')->where('status','active')->limit(5);
            $result = $query->get()->toArray();
        }
        return $result;
    }
    public function countItems($params = null,$options = null) { 
        if($options['task'] == 'count-items') {
            $query = self::select(DB::raw('count(id) as count,status'))
            ->groupBy('status');
        }
        if($params['search']['value'] != '') {
            if($params['search']['field'] == 'all') {
                $query->where(function($query) use ($params) {
                    foreach ($this->fieldSearchAccepted as $key => $value) {
                        $query->orWhere($value,'LIKE',"%{$params['search']['value']}%");
                    }
                });
            } else if(in_array($params['search']['field'],$this->fieldSearchAccepted)){
                $query->where($params['search']['field'],'LIKE',"%{$params['search']['value']}%");
            }
        }
        
        $result = $query->get()->toArray();
        return $result;
    }
    public function saveItems($params = null,$options = null){
        if($options['task'] == 'change-status'){
            $status = ($params['status'] == 'active') ? 'inactive' : 'active';
            $this->where('id',$params['id'])->update(['status' => $status]);
        }
        if($options['task'] == 'change-level'){
            $this->where('id',$params['id'])->update(['level' => $params['level']]);
        }
        if($options['task'] == 'change-password'){
            $this->where('id',$params['id'])->update(['password' => md5($params['password'])]);
        }
        if($options['task'] == 'add-item'){
            $params['created_by'] = 'HaiDepTrai';
            $params['created'] = date('Y-m-d');
            $params['avatar'] = $this->uploadThumb($params['avatar']);
            $params['password'] = md5($params['password']);
            $this->insert($this->prepareParams($params));
        }
        if($options['task'] == 'edit-item'){
            
            if(!empty($params['avatar'])) {
                Storage::disk('zvn_store_images')->delete("$this->folderUpload/".$params['avatar_current']);
                $params['avatar'] = $this->uploadThumb($params['avatar']);
            }
            $params['modified_by'] = 'HaiDepTrai';
            $params['modified'] = date('Y-m-d');
            $this->where('id',$params['id'])->update($this->prepareParams($params));
        }
    }
    public function deleteItem($params = null,$options = null){
        if($options['task'] == 'delete-item'){
            $item = $this->getItem($params,['task' => 'get-avatar']);
            $this->deleteThumb($item['avatar']);
            $this->where('id',$params['id'])->delete();
        }
    }
    public function getItem($params = null,$options = null){
        $result = null;
        if($options['task'] == 'get-item'){
            $result = $this->select('id','username','fullname','email','level','avatar','created','created_by','modified','modified_by','status')->where('id',$params['id'])->first();
        }
        if($options['task'] == 'get-avatar'){
            $result = $this->select('avatar')->where('id',$params['id'])->first();
        }
        if($options['task'] == 'auth-login') {
            $result = self::select('id', 'username', 'fullname', 'email', 'level', 'avatar')
                    ->where('status', 'active')
                    ->where('email', $params['email'])
                    ->where('password', md5($params['password']) )->first();

            if($result) $result = $result->toArray();
        }
        return $result;
    }

}

<?php

namespace App\Models;

use App\Models\AdminModel;
use DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
class SliderModel extends AdminModel
{
    public function __construct() {
        $this->table = 'slider';
        $this->folderUpload = 'slider';
        $this->fieldSearchAccepted = ['id','name','description','link'];
        $this->crudNotAccepted = ['_token','thumb_current'];
    }
    public function listItems($params = null,$options = null) {
        $result = null;
            if($options['task'] == 'admin-list-items') {
                $query = $this->select('id','name','description','link','thumb','created','created_by','modified','modified_by','status');
            
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
            $query = $this->select('id','name','description','link','thumb','created','created_by','modified','modified_by','status')->where('status','active')->limit(5);
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
        if($options['task'] == 'add-item'){
            $params['created_by'] = 'HaiDepTrai';
            $params['created'] = date('Y-m-d');
            $params['thumb'] = $this->uploadThumb($params['thumb']);
            $this->insert($this->prepareParams($params));
        }
        if($options['task'] == 'edit-item'){
            
            if(!empty($params['thumb'])) {
                Storage::disk('zvn_store_images')->delete("$this->folderUpload/".$params['thumb_current']);
                $params['thumb'] = $this->uploadThumb($params['thumb']);
            }
            $params['modified_by'] = 'HaiDepTrai';
            $params['modified'] = date('Y-m-d');
            $this->where('id',$params['id'])->update($this->prepareParams($params));
        }
    }
    public function deleteItem($params = null,$options = null){
        if($options['task'] == 'delete-item'){
            $item = $this->getItem($params,['task' => 'get-thumb']);
            $this->deleteThumb($item['thumb']);
            $this->where('id',$params['id'])->delete();
        }
    }
    public function getItem($params = null,$options = null){
        $result = null;
        if($options['task'] == 'get-item'){
            $result = $this->select('id','name','description','link','thumb','created','created_by','modified','modified_by','status')->where('id',$params['id'])->first();
        }
        if($options['task'] == 'get-thumb'){
            $result = $this->select('thumb')->where('id',$params['id'])->first();
        }
        return $result;
    }

}

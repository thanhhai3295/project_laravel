<?php

namespace App\Models;

use App\Models\AdminModel;
use DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
class CategoryModel extends AdminModel
{
    public function __construct() {
        $this->table = 'category';
        $this->folderUpload = 'category';
        $this->fieldSearchAccepted = ['id','name'];
        $this->crudNotAccepted = ['_token'];
    }
    public function listItems($params = null,$options = null) {
        $result = null;
            if($options['task'] == 'admin-list-items') {
                $query = $this->select('id','is_home','display','name','created','created_by','modified','modified_by','status');
            
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
        if($options['task'] == 'menu-list-items') {
            $query = $this->select('id','name')->where('status','active')->limit(8);
            $result = $query->get()->toArray();
        }
        if($options['task'] == 'news-list-items-is-home') {
            $query = $this->select('id','name','display')->where('status','active')->where('is_home',1);
            $result = $query->get()->toArray();
        }
        if($options['task'] == 'news-list-items-in-selectbox') {
            $query = $this->select('id','name')->where('status','active')->orderBy('name','asc');
            $result = $query->pluck('name','id')->toArray();
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
        if($options['task'] == 'change-display'){
            $this->where('id',$params['id'])->update(['display' => $params['display'] ]);
        }
        if($options['task'] == 'change-is-home'){
            $isHome = ($params['isHome'] == 1) ? 0 : 1;
            $this->where('id',$params['id'])->update(['is_home' => $isHome]);
        }
        if($options['task'] == 'add-item'){
            $params['created_by'] = 'HaiDepTrai';
            $params['created'] = date('Y-m-d');
            $this->insert($this->prepareParams($params));
        }
        if($options['task'] == 'edit-item'){
            $params['modified_by'] = 'HaiDepTrai';
            $params['modified'] = date('Y-m-d');
            $this->where('id',$params['id'])->update($this->prepareParams($params));
        }
    }
    public function deleteItem($params = null,$options = null){
        if($options['task'] == 'delete-item'){
            $this->where('id',$params['id'])->delete();
        }
    }
    public function getItem($params = null,$options = null){
        $result = null;
        if($options['task'] == 'get-item'){
            $result = $this->select('id','name','created','created_by','modified','modified_by','status')->where('id',$params['id'])->first();
        }
        if($options['task'] == 'news-get-items'){
            $result = $this->select('id','name','display')->where('id',$params['category_id'])->first();
            if($result) $result = $result->toArray();
        }
        return $result;
    }

}

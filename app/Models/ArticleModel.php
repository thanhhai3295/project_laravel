<?php

namespace App\Models;

use App\Models\AdminModel;
use DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
class ArticleModel extends AdminModel
{
    public function __construct() {
        $this->table = 'article as a';
        $this->folderUpload = 'article';
        $this->fieldSearchAccepted = ['name','content'];
        $this->crudNotAccepted = ['_token','thumb_current'];
    }
    public function listItems($params = null,$options = null) {
        $result = null;
            if($options['task'] == 'admin-list-items') {
                $query = $this->select('a.id','a.name','a.content','a.thumb','a.created','a.created_by','a.modified','a.modified_by','a.status','c.name as category_name')->leftJoin('category as c', 'a.category_id', '=', 'c.id');
            
            if($params['filter']['status'] != 'all') {
                $query->where('a.status','=',$params['filter']['status']);
            }
            if(!empty($params['filter']['category'])) {
                $query->where('a.category_id','=',$params['filter']['category']);
            }
            if($params['search']['value'] != '') {
                if($params['search']['field'] == 'all') {
                    $query->where(function($query) use ($params) {
                        foreach ($this->fieldSearchAccepted as $key => $value) {
                            $query->orWhere('a.'.$value,'LIKE',"%{$params['search']['value']}%");
                        }
                    });
                } else if(in_array($params['search']['field'],$this->fieldSearchAccepted)){
                    $query->where('a.'.$params['search']['field'],'LIKE',"%{$params['search']['value']}%");
                }
            }
            $result = $query->orderBy('a.id','desc')->paginate($params['pagination']['totalItemsPerPage']);  
        }
        if($options['task'] == 'news-list-items') {
            $query = $this->select('id','name','content','thumb','created','created_by','modified','modified_by','status')->where('status','active')->limit(5);
            $result = $query->get()->toArray();
        }
        
        return $result;
    }
    public function countItems($params = null,$options = null) { 
        if($options['task'] == 'count-items') {
            $query = $this->select(array(DB::raw('count(a.id) as count'),'a.status'))
            ->leftJoin('category as c', 'a.category_id', '=', 'c.id')->groupBy('status');
        }
        if($params['search']['value'] != '') {
            if($params['search']['field'] == 'all') {
                $query->where(function($query) use ($params) {
                    foreach ($this->fieldSearchAccepted as $key => $value) {
                        $query->orWhere('a.'.$value,'LIKE',"%{$params['search']['value']}%");
                    }
                });
            } else if(in_array($params['search']['field'],$this->fieldSearchAccepted)){
                $query->where('a.'.$params['search']['field'],'LIKE',"%{$params['search']['value']}%");
            }
        }
        if(!empty($params['filter']['category'])) {
            $query->where('a.category_id','=',$params['filter']['category']);
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
            $result = $this->select('id','name','content','category_id','thumb','created','created_by','modified','modified_by','status')->where('id',$params['id'])->first();
        }
        if($options['task'] == 'get-thumb'){
            $result = $this->select('thumb')->where('id',$params['id'])->first();
        }
        return $result;
    }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SliderModel extends Model
{
    protected $table = 'slider';
    public $timestamps = false;
    const CREATED_AT = 'created';
    const UPDATED_AT = 'modified';

    public function listItems($params,$options) {
        $result = null;
        if($options['task'] == 'admin-list-items') {
            $result = self::select('id','name','description','link','thumb','created','created_by','modified','modified_by','status')
            //->where('id','>',4)
            ->orderBy('id','desc')
            ->paginate($params['pagination']['totalItemsPerPage']);
        }
        return $result;
    }
}

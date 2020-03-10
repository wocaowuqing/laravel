<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class DataModel extends Model
{
    protected $table = 'data';//关联数据表   指定表名
    protected $guarded = [];//可以被赋值的字段
    public $primaryKey="data_id";
    public $timestamps = false;
}

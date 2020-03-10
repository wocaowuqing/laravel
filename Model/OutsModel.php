<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class OutsModel extends Model
{
    protected $table = 'outs';//关联数据表   指定表名
    protected $guarded = [];//可以被赋值的字段
    public $primaryKey="outr_id";
    public $timestamps = false;
}

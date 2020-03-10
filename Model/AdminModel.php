<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class AdminModel extends Model
{
    protected $table = 'admin';//关联数据表   指定表名
    protected $guarded = [];//可以被赋值的字段
    public $primaryKey="admin_id";
    public $timestamps = false;
}

<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class MsgModel extends Model
{
    protected $table = 'msg';//关联数据表   指定表名
    protected $guarded = [];//可以被赋值的字段
    public $primaryKey="msg_id";
    public $timestamps = false;
}

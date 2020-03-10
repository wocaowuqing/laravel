<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class WheelModel extends Model
{
    protected $table = 'wheel';//关联数据表   指定表名
    protected $guarded = [];//可以被赋值的字段
    public $primaryKey="wheel_id";
    public $timestamps = false;

}

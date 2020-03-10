<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class MatchModel extends Model
{
    protected $table = 'match';//关联数据表   指定表名
    protected $guarded = [];//可以被赋值的字段
    public $primaryKey="match_id";
    public $timestamps = false;
}

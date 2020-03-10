<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class TeamModel extends Model
{
    protected $table = 'team';//关联数据表   指定表名
    protected $guarded = [];//可以被赋值的字段
    public $primaryKey="team_id";
    public $timestamps = false;
}

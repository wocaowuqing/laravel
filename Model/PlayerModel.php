<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class PlayerModel extends Model
{
    protected $table = 'player';//关联数据表   指定表名
    protected $guarded = [];//可以被赋值的字段
    public $primaryKey="player_id";
    public $timestamps = false;
}

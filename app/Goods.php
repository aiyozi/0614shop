<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
class Goods extends Model
{
    protected $table="Goods";
    protected $primaryKey="goods_id";
    public $timestamps=false;

    public static function getlist(){
        return self::select("goods_id",'goods_img')->where("is_slide",1)->take(3)->get();
    }
}

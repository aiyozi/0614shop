<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
class Category extends Model
{
    protected $table="Category";
    protected $primaryKey="cart_id";
    public $timestamps=false;
}

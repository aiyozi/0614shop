<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $table="Cart";
    protected $primaryKey="cart_id";
    public $timestamps=false;
}

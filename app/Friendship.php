<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Friendship extends Model
{
    protected $table="Friendship";
    protected $primaryKey="frie_id";
    public $timestamps=false;
}

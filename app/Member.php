<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $table="Member";
    protected $primaryKey="mem_id";
    public $timestamps=false;
}

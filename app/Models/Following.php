<?php

namespace Hifone;

use Illuminate\Database\Eloquent\Model;

class Following extends Model
{
     protected $table = 'followings';
    
    public $timestamps = false;
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Makifespors extends Model
{
    use SoftDeletes;

   protected $fillable = ['takimadi','puan','gecmis','oyunlar'];
   protected $casts = ['oyunlar' => 'array'];

}

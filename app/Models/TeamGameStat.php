<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TeamGameStat extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'team_id',
        'game',
        'puan',
        'galibiyet',
        'beraberlik',
        'maglubiyet',
    ];
     public function team()
    {
        return $this->belongsTo(Makifespors::class, 'team_id');
    }
}

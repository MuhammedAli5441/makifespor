<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GameMatch extends Model
{
    protected $table = 'matches';

    protected $fillable = [
        'game',
        'team_home',
        'team_away',
        'match_date',
    ];

    protected $casts = [
        'match_date' => 'datetime',
    ];
}

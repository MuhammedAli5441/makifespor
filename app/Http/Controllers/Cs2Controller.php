<?php

namespace App\Http\Controllers;

use App\Models\GameMatch;
use App\Models\Makifespors;
use App\Models\TeamGameStat;
use Illuminate\Http\Request;
use Carbon\Carbon;
class Cs2Controller extends Controller
{
public function yonlendir()
{
    // CS2 takımlarının istatistiklerini çek
    $cs2Teams = TeamGameStat::with('team')
        ->where('game', 'cs2')
        ->orderBy('puan', 'desc')
        ->get();

    // Gelecek CS2 maçlarını çek
    $matches = GameMatch::where('game', 'cs2')
        ->where('match_date', '>', Carbon::now())
        ->orderBy('match_date', 'asc')
        ->get();

    return view('cstablosu', compact('cs2Teams', 'matches'));
}
}

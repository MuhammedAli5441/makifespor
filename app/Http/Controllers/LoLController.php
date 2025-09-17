<?php

namespace App\Http\Controllers;

use App\Models\GameMatch;
use App\Models\Makifespors;
use App\Models\TeamGameStat;
use Illuminate\Http\Request;
use Carbon\Carbon;

class LoLController extends Controller
{
public function yonlendir()
{
    $now = Carbon::now();

    // 📌 LoL takımlarını puana göre sırala
    $lolTeams = TeamGameStat::with('team')
        ->where('game', 'lol')
        ->orderBy('puan', 'desc')
        ->get();

    // 📌 Yaklaşan (planlı) LoL maçları
    $upcomingMatches = GameMatch::where('game', 'lol')
        ->where('status', 'planned')
        ->where('match_date', '>', $now)
        ->orderBy('match_date', 'asc')
        ->get();

    // 📌 Bitmiş LoL maçları
    $finishedMatches = GameMatch::where('game', 'lol')
        ->where('status', 'finished')
        ->orderBy('match_date', 'desc')
        ->get();

    return view('loltablosu', compact(
        'lolTeams',
        'upcomingMatches',
        'finishedMatches'
    ));
}

}

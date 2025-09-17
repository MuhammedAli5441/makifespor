<?php

namespace App\Http\Controllers;

use App\Models\GameMatch;
use App\Models\Makifespors;
use App\Models\TeamGameStat;
use Illuminate\Http\Request;
use Carbon\Carbon;
class ValorantController extends Controller
{
public function yonlendir()
{
    $now = Carbon::now();

    // 📌 Valorant takımlarını puana göre sırala
    $valorantTeams = TeamGameStat::with('team')
        ->where('game', 'valorant')
        ->orderBy('puan', 'desc')
        ->get();

    // 📌 Yaklaşan (planlı) Valorant maçları
    $upcomingMatches = GameMatch::where('game', 'valorant')
        ->where('status', 'planned')
        ->where('match_date', '>', $now)
        ->orderBy('match_date', 'asc')
        ->get();

    // 📌 Bitmiş Valorant maçları
    $finishedMatches = GameMatch::where('game', 'valorant')
        ->where('status', 'finished')
        ->orderBy('match_date', 'desc')
        ->get();

    return view('valoranttablosu', compact(
        'valorantTeams',
        'upcomingMatches',
        'finishedMatches'
    ));
}


}

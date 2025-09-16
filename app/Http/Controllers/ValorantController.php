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
    // Valorant takımlarının istatistiklerini çek
    $valorantTeams = TeamGameStat::with('team')
        ->where('game', 'valorant')
        ->orderBy('puan', 'desc')
        ->get();

    // Gelecek maçları çek
    $matches = GameMatch::where('game', 'valorant')
        ->where('match_date', '>', Carbon::now())
        ->orderBy('match_date', 'asc')
        ->get();

    return view('valoranttablosu', compact('valorantTeams', 'matches'));
}


}

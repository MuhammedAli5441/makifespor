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
    // LoL takımlarını çek (sadece lol istatistikleri)
    $lolTeams = TeamGameStat::with('team')
        ->where('game', 'lol')
        ->orderBy('puan', 'desc')
        ->get();

    // Yaklaşan LoL maçları
    $matches = GameMatch::where('game', 'lol')
        ->where('match_date', '>', Carbon::now())
        ->orderBy('match_date', 'asc')
        ->get();

    return view('loltablosu', compact('lolTeams', 'matches'));
}
}

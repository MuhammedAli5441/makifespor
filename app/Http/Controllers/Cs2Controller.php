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
    $now = now();

    // Sıradaki (henüz oynanmamış) CS2 maçları
    $upcomingMatches = GameMatch::where('game', 'cs')
        ->where('status', 'planned')
        ->where('match_date', '>', $now)
        ->orderBy('match_date', 'asc')
        ->get();

    // Bitmiş (oynanmış) CS2 maçları
    $finishedMatches = GameMatch::where('game', 'cs')
        ->where('status', 'finished')
        ->orderBy('match_date', 'desc')
        ->get();

    // Takım istatistikleri
    $cs2Teams = TeamGameStat::with('team')
        ->where('game', 'cs2')
        ->orderByDesc('puan')
        ->get();

    return view('cstablosu', compact('upcomingMatches','finishedMatches','cs2Teams'));
}

}

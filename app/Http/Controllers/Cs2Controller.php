<?php

namespace App\Http\Controllers;

use App\Models\GameMatch;
use App\Models\Makifespors;
use Illuminate\Http\Request;
use Carbon\Carbon;
class Cs2Controller extends Controller
{
public function yonlendir()
{
    // Takımlar ve oyun istatistikleri birlikte çekiliyor
    $takimlar = Makifespors::with(['gameStats' => function($q) {
        $q->where('game', 'cs2');
    }])->get();

    // Yaklaşan CS2 maçlarını çek
    $matches = GameMatch::where('game', 'cs2')
        ->where('match_date', '>', Carbon::now())
        ->orderBy('match_date', 'asc')
        ->get();

    return view('cstablosu', compact('takimlar', 'matches'));
}
}

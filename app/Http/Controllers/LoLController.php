<?php

namespace App\Http\Controllers;

use App\Models\GameMatch;
use App\Models\Makifespors;
use Illuminate\Http\Request;

class LoLController extends Controller
{
   public function yonlendir()
{

    $takimlar = Makifespors::whereJsonContains('oyunlar', 'League of Legends')->get();


    $matches = GameMatch::where('game', 'lol')
        ->where('match_date', '>', now())
        ->orderBy('match_date', 'asc')
        ->get();

    return view('loltablosu', compact('takimlar', 'matches'));
}
}

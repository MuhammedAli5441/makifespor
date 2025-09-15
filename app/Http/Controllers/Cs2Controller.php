<?php

namespace App\Http\Controllers;

use App\Models\GameMatch;
use App\Models\Makifespors;
use Illuminate\Http\Request;

class Cs2Controller extends Controller
{
 public function yonlendir()
{

    $takimlar = Makifespors::whereJsonContains('oyunlar', 'CS2')->get();


    $matches = GameMatch::where('game', 'cs')
        ->where('match_date', '>', now())
        ->orderBy('match_date', 'asc')
        ->get();

    return view('cstablosu', compact('takimlar', 'matches'));
}
}

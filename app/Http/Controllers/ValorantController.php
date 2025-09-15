<?php

namespace App\Http\Controllers;

use App\Models\GameMatch;
use App\Models\Makifespors;
use Illuminate\Http\Request;
use Carbon\Carbon;
class ValorantController extends Controller
{
public function yonlendir()
{
    $takimlar = Makifespors::whereJsonContains('oyunlar', 'Valorant')->get();

    $matches = GameMatch::where('game', 'valorant')
        ->where('match_date', '>', Carbon::now()) // 🟢 artık Carbon
        ->orderBy('match_date', 'asc')
        ->get();

    return view('valoranttablosu', compact('takimlar', 'matches'));
}


}

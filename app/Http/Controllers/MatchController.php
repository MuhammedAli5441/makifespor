<?php

namespace App\Http\Controllers;

use App\Models\GameMatch;
use Illuminate\Http\Request;

class MatchController extends Controller
{
     public function lol()
    {
        $matches = GameMatch::where('game', 'lol')
            ->where('match_date', '>', now())
            ->orderBy('match_date', 'asc')
            ->get();


        return view('loltablosu', compact('matches'));
    }

    public function cs()
    {
        $matches = GameMatch::where('game', 'cs')
            ->where('match_date', '>', now())
            ->orderBy('match_date', 'asc')
            ->get();

        return view('cstablosu', compact('matches'));
    }

    public function valorant()
    {
        $matches = GameMatch::where('game', 'valorant')
            ->where('match_date', '>', now())
            ->orderBy('match_date', 'asc')
            ->get();

        return view('valoranttablosu', compact('matches'));
    }
}

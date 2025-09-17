<?php

namespace App\Http\Controllers;

use App\Models\GameMatch;
use Illuminate\Http\Request;
use Carbon\Carbon;

class HomeController extends Controller
{
public function index()
{
    $now = Carbon::now();

    // Gelecek (planlı) maçlar
    $matches = GameMatch::where('match_date', '>', $now)
        ->orderBy('match_date', 'asc')
        ->get();

    // Bitmiş (geçmiş) maçlar
    $finishedMatches = GameMatch::where('match_date', '<=', $now)
        ->where('status', 'finished')
        ->orderBy('match_date', 'desc')
        ->get();

    return view('anasayfa', compact('matches', 'finishedMatches'));
}

}

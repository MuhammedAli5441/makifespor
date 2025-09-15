<?php

namespace App\Http\Controllers;

use App\Models\GameMatch;
use Illuminate\Http\Request;
use Carbon\Carbon;

class HomeController extends Controller
{
   public function index()
{
    $matches = GameMatch::where('match_date', '>', Carbon::now())
        ->orderBy('match_date', 'asc')
        ->get();

    return view('anasayfa', compact('matches'));
}
}

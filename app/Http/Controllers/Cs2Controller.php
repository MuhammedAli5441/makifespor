<?php

namespace App\Http\Controllers;

use App\Models\Makifespors;
use Illuminate\Http\Request;

class Cs2Controller extends Controller
{
    public function yonlendir() {
        $takimlar = Makifespors::whereJsonContains('oyunlar', 'CS2')->get();

        return view('cstablosu',compact('takimlar'));
    }
}

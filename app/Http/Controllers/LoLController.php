<?php

namespace App\Http\Controllers;

use App\Models\Makifespors;
use Illuminate\Http\Request;

class LoLController extends Controller
{
    public function yonlendir() {
        $takimlar = Makifespors::whereJsonContains('oyunlar', 'League of Legends')->get();

        return view('loltablosu',compact('takimlar'));
    }
}

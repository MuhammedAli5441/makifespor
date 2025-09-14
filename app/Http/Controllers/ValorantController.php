<?php

namespace App\Http\Controllers;

use App\Models\Makifespors;
use Illuminate\Http\Request;

class ValorantController extends Controller
{
    public function yonlendir() {
         $takimlar = Makifespors::whereJsonContains('oyunlar', 'Valorant')->get();

        return view('valoranttablosu',compact('takimlar'));
    }


}

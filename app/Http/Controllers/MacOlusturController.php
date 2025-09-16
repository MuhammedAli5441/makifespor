<?php

namespace App\Http\Controllers;

use App\Models\GameMatch;
use App\Models\Makifespors;
use Illuminate\Http\Request;

class MacOlusturController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
   public function create()
    {
    $takimlar = Makifespors::all();
    return view('macolustur', compact('takimlar'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

    $data = $request->validate([
        'game'       => 'required|in:lol,cs,valorant',
        'team_home'  => 'required|string|max:255',
        'team_away'  => 'required|string|max:255|different:team_home',
        'match_date' => 'required|date|after:now',
    ]);

    GameMatch::create([
        'game'       => $data['game'],
        'team_home'  => $data['team_home'],
        'team_away'  => $data['team_away'],
        'match_date' => $data['match_date'],
    ]);

    return back()->with('success', 'Maç eklendi!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

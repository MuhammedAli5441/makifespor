<?php

namespace App\Http\Controllers;

use App\Http\Requests\TakimGuncelleRequest;
use App\Http\Requests\TakimOlusturRequest;
use App\Models\GameMatch;
use App\Models\Makifespors;
use App\Models\TeamGameStat;
use Illuminate\Http\Request;
use Carbon\Carbon;

class TakimController extends Controller
{
    /**
     * Display a listing of the resource.
     */
public function index()
{
    if (!auth()->check()) {
        return redirect()->route('anasayfa');
    }

    $matches = GameMatch::where('match_date', '>', now())
        ->orderBy('match_date', 'asc')
        ->get();

    // Her oyun için takımları sıralı çek
    $cs2Teams = TeamGameStat::with('team')
        ->where('game', 'cs2')
        ->orderBy('puan','desc')
        ->get();

    $lolTeams = TeamGameStat::with('team')
        ->where('game', 'lol')
        ->orderBy('puan','desc')
        ->get();

    $valorantTeams = TeamGameStat::with('team')
        ->where('game', 'valorant')
        ->orderBy('puan','desc')
        ->get();

    return view('adminanasayfa', compact('matches','cs2Teams','lolTeams','valorantTeams'));
}


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (!auth()->check()) {
        return redirect()->route('anasayfa');
        }

        return view ('takimolustur');

    }

    /**
     * Store a newly created resource in storage.
     */
public function store(TakimOlusturRequest $request)
{
    if (!auth()->check()) {
        return redirect()->route('anasayfa');
    }

    $validated = $request->validated();

    // 1) Takımı kaydet
    $team = Makifespors::create([
        'takimadi' => $validated['takimadi'],
        'oyunlar'  => $validated['oyunlar'], // model cast'inde array -> json otomatik
        'gecmis'   => '',                    // artık kullanılmıyor ama alan varsa boş ver
        'puan'     => 0,                     // eski alan varsa 0 bırak
    ]);

    // 2) Seçilen oyunlar için istatistik satırları oluştur
    foreach ($validated['oyunlar'] as $game) {
        TeamGameStat::create([
            'team_id'     => $team->id,
            'game'        => $game,      // cs2/lol/valorant
            'puan'        => 0,
            'galibiyet'   => 0,
            'maglubiyet'  => 0,
        ]);
    }

    return redirect()
        ->route('takimlar.index')
        ->with('success', 'Takım başarıyla eklendi.');
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
           if (!auth()->check()) {
        return redirect()->route('anasayfa');
        }
        $takim = Makifespors::find($id) ?? abort(404,'Takım Bulunamadı');
        return view('takimduzenle',compact('takim'));
    }

    /**
     * Update the specified resource in storage.
     */
public function update(TakimGuncelleRequest $request, string $id)
{
    if (!auth()->check()) {
        return redirect()->route('anasayfa');
    }

    $takim = Makifespors::findOrFail($id);

    // Takım temel bilgilerini güncelle
    $takim->update([
        'takimadi' => $request->takimadi,
        'oyunlar'  => $request->oyunlar, // array olarak gelir → cast ile json olur
    ]);

    // İstatistikler varsa güncelle
    if (!empty($request->stats)) {
        foreach ($request->stats as $statId => $values) {
            $stat = TeamGameStat::find($statId);
            if ($stat && $stat->team_id == $takim->id) {
                $galibiyet = (int)($values['galibiyet'] ?? 0);
                $maglubiyet = (int)($values['maglubiyet'] ?? 0);

                $stat->update([
                    'galibiyet' => $galibiyet,
                    'maglubiyet' => $maglubiyet,
                    'puan' => $galibiyet * 3,
                ]);
            }
        }
    }

    return redirect()
        ->route('takimlar.index')
        ->with('success', 'Takım başarıyla güncellendi.');
}



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

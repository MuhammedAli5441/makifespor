<?php

namespace App\Http\Controllers;

use App\Models\GameMatch;
use App\Models\Makifespors;
use App\Models\TeamGameStat;
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
        'game'        => $data['game'],
        'team_home'   => $data['team_home'],
        'team_away'   => $data['team_away'],
        'match_date'  => $data['match_date'],
        'status'      => 'planned', //  başlangıçta planned
        'home_score'  => 0,
        'away_score'  => 0,
        'winner'      => null
    ]);

    return redirect()->back()->with('success', 'Maç başarıyla oluşturuldu!');
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
public function update(Request $request, $id)
{
    $match = GameMatch::findOrFail($id);

    // Eğer maç hala planned durumdaysa skor zorunlu olmasın
    if ($match->status === 'planned') {
        $request->validate([
            'game' => 'required|in:cs2,lol,valorant',
            'team_home' => 'required|string|max:255|different:team_away',
            'team_away' => 'required|string|max:255',
            'match_date' => 'required|date|after:now',
        ]);

        // Planlı maçın temel bilgilerini güncelle
        $match->game = $request->game;
        $match->team_home = $request->team_home;
        $match->team_away = $request->team_away;
        $match->match_date = $request->match_date;
        $match->save();

        return redirect()->back()->with('success', 'Maç bilgileri güncellendi!');
    }

    // Eğer maç finished olacaksa skorlar zorunlu olsun
    $request->validate([
        'home_score' => 'required|integer|min:0',
        'away_score' => 'required|integer|min:0',
    ]);

    // 📝 Skorları güncelle
    $match->home_score = $request->home_score;
    $match->away_score = $request->away_score;
    $match->status = 'finished';

    // 🏆 Kazananı otomatik belirle
    if ($request->home_score > $request->away_score) {
        $match->winner = $match->team_home;
    } elseif ($request->away_score > $request->home_score) {
        $match->winner = $match->team_away;
    } else {
        return redirect()->back()->with('error', 'Beraberlik olamaz!');
    }

    $match->save();

    // 📊 Takım istatistiklerini güncelle
    $winnerName = $match->winner;
    $loserName  = $winnerName === $match->team_home ? $match->team_away : $match->team_home;

    $winnerTeam = Makifespors::where('takimadi', $winnerName)->first();
    $loserTeam  = Makifespors::where('takimadi', $loserName)->first();

    if ($winnerTeam) {
        $stat = TeamGameStat::firstOrCreate(
            ['team_id' => $winnerTeam->id, 'game' => $match->game],
            ['galibiyet' => 0, 'maglubiyet' => 0, 'puan' => 0]
        );

        $stat->galibiyet++;
        $stat->puan += 3;
        $stat->save();
    }

    if ($loserTeam) {
        $stat = TeamGameStat::firstOrCreate(
            ['team_id' => $loserTeam->id, 'game' => $match->game],
            ['galibiyet' => 0, 'maglubiyet' => 0, 'puan' => 0]
        );

        $stat->maglubiyet++;
        $stat->save();
    }

    return redirect()->back()->with('success', 'Maç sonucu ve puanlar güncellendi!');
}



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

public function finish(Request $request, $id)
{
    $match = GameMatch::findOrFail($id);

    $homeScore = (int)$request->input('home_score');
    $awayScore = (int)$request->input('away_score');

    $winner = null;
    if ($homeScore > $awayScore) {
        $winner = $match->team_home;
    } elseif ($awayScore > $homeScore) {
        $winner = $match->team_away;
    }

    // Kazanana puan + galibiyet
    if ($winner) {
        $team = Makifespors::where('takimadi', $winner)->first();
        if ($team) {
            $stat = $team->gameStats()->where('game', $match->game)->first();
            if ($stat) {
                $stat->increment('galibiyet');
                $stat->increment('puan', 3);
            }
        }
    }

    $match->update([
        'home_score' => $homeScore,
        'away_score' => $awayScore,
        'winner' => $winner,
        'status' => 'finished'
    ]);

    return back()->with('success', 'Maç başarıyla tamamlandı.');
}



}


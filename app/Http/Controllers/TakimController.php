<?php

namespace App\Http\Controllers;

use App\Http\Requests\TakimGuncelleRequest;
use App\Http\Requests\TakimOlusturRequest;
use App\Models\GameMatch;
use App\Models\Makifespors;
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

    $takimlar = Makifespors::orderBy('puan', 'desc')->get();

    $matches = GameMatch::where('match_date', '>', Carbon::now())
        ->orderBy('match_date', 'asc')
        ->get();

    return view('adminanasayfa', compact('takimlar', 'matches'));
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

    $data = [
        'takimadi' => $request->takimadi,
        'puan' => $request->puan,
        'gecmis' => $request->gecmis,
        'oyunlar' => $request->oyunlar,
    ];

    Makifespors::create($data);

    return redirect()
        ->route("takimlar.index")
        ->with("success", "Takım Başarıyla Eklendi");
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

    $takim = Makifespors::find($id) ?? abort(404, 'Takım Bulunamadı');

    $data = $request->except('_method', '_token');
    $data['oyunlar'] = $request->oyunlar; // ✅ seçilen oyunları ekle

    $takim->update($data);

    return redirect()
        ->route("takimlar.index")
        ->with("success", "Takım Başarıyla Güncellendi");
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

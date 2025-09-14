<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class KayitController extends Controller
{
 public function gonder(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        '_replyto' => 'required|email|max:255',
        'team' => 'required|string|max:255',
        'message' => 'required|string',
        'game' => 'required|array|min:1',
        'game.*' => 'string|max:50',
    ]);

    $data = $request->only('name', '_replyto', 'team', 'message', 'game');
    $games = implode(', ', $data['game']);

    try {
        Mail::raw(
            "Ad Soyad: {$data['name']}\n"
            ."E-Posta: {$data['_replyto']}\n"
            ."Takım: {$data['team']}\n"
            ."Oyunlar: {$games}\n"
            ."Mesaj: {$data['message']}",
            function ($message) use ($data) {
                $message->to('makifespor@aliozgol.com.tr')
                        ->subject('Yeni Kayıt Formu')
                        ->replyTo($data['_replyto']);
            }
        );

        return redirect()->back()->with('success', 'Formunuz başarıyla gönderildi!');
    } catch (\Exception $e) {
        \Log::error('Mail gönderilemedi: '.$e->getMessage());

        return redirect()->back()
            ->with('error', 'Mail gönderilirken bir hata oluştu. Lütfen tekrar deneyin.');
    }
}

}

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
        ]);

        $data = $request->only('name', '_replyto', 'team', 'message');

        Mail::raw("Ad Soyad: {$data['name']}\nE-Posta: {$data['_replyto']}\nTakım: {$data['team']}\nMesaj: {$data['message']}", function ($message) use ($data) {
            $message->to('makifespor@aliozgol.com.tr')
                    ->subject('Yeni Kayıt Formu');
            $message->replyTo($data['_replyto']);
        });

        return redirect()->back()->with('success', 'Formunuz başarıyla gönderildi!');
    }
}

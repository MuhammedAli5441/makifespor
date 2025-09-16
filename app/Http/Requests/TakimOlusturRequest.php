<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TakimOlusturRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
public function rules(): array
{
    return [
        'takimadi'   => ['required', 'string', 'max:255'],
        'oyunlar'    => ['required', 'array', 'min:1'],
        'oyunlar.*'  => ['in:cs2,lol,valorant'], // İsimler cs2/lol/valorant olarak kalacak
    ];
}

public function messages(): array
{
    return [
        'takimadi.required'  => 'Takım adı zorunludur.',
        'oyunlar.required'   => 'En az bir oyun seçmelisiniz.',
        'oyunlar.array'      => 'Oyun seçimi hatalı.',
        'oyunlar.min'        => 'En az bir oyun seçmelisiniz.',
        'oyunlar.*.in'       => 'Seçilen oyun geçersiz.',
    ];
}

}

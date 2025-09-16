<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TakimGuncelleRequest extends FormRequest
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
        'takimadi'   => 'required|string|max:255',
        'oyunlar'    => 'required|array|min:1',
        'oyunlar.*'  => 'in:cs2,lol,valorant',
        'stats'      => 'nullable|array',
    ];
}

public function messages(): array
{
    return [
        'takimadi.required'  => 'Lütfen takım adı giriniz.',
        'oyunlar.required'   => 'Lütfen en az bir oyun seçiniz.',
        'oyunlar.array'      => 'Oyun seçimi hatalı.',
        'oyunlar.min'        => 'Lütfen en az bir oyun seçiniz.',
        'oyunlar.*.in'       => 'Seçilen oyun geçersiz.',
    ];
}

}

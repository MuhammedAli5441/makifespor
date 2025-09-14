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
        'takimadi' => 'required',
        'puan' => 'required',
        'gecmis' => 'required',
        'oyunlar' => 'required|array|min:1',
    ];
}

public function messages(): array
{
    return [
        'takimadi.required' => 'Lütfen Takım Adı Giriniz',
        'puan.required' => 'Lütfen Puan Giriniz',
        'gecmis.required' => 'Lütfen Takım Geçmişi Giriniz',
        'oyunlar.required' => 'Lütfen oyun seçiniz',
        'oyunlar.min' => 'Lütfen en az bir oyun seçiniz',
    ];
}

}

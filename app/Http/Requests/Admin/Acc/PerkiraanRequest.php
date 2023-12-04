<?php

namespace App\Http\Requests\Acc;

use Illuminate\Foundation\Http\FormRequest;

class PerkiraanRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'kodeperkiraan' => 'required|string|max:25|unique:perkiraans',
            'namaperkiraan' => 'required|string|max:255|unique:perkiraans',
            'level' => 'required|integer',
            'tingkat' => 'required|integer',
            'debet_kredit' => 'required|in:debet,kredit',
        ];
    }

    public function messages()
    {
        return [

            'kodeperkiraan.required' => 'Kode Perkiraan harus di isi',

        ];
    }
}

<?php

namespace App\Http\Requests\Checker;

use Illuminate\Foundation\Http\FormRequest;

class PosRequest extends FormRequest
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
            'kodepos' => 'required|string|min:2|unique:pos,kodepos',
            'namapos' => 'required|string|max:255',
            'arah' => 'required|string|min:5',
            'wilayah' => 'required|string|min:5',
            'status' => 'required|in:active,inactive,pending',
        ];
    }

    public function messages()
    {
        return [
            'kodepos.required' => 'Kode pos harus diisi.',
            'kodepos.unique' => 'Kode pos sudah digunakan, silakan gunakan kode pos yang lain.',
        ];
    }
}

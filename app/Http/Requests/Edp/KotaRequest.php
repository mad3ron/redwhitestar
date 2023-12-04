<?php

namespace App\Http\Requests\Edp;

use Illuminate\Foundation\Http\FormRequest;

class KotaRequest extends FormRequest
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
            'kota' => 'required|string|max:225|unique:kotas',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Nama Kota harus diisi',
            'name.unique' => 'Nama Kota sudah ada.',
        ];
    }
}

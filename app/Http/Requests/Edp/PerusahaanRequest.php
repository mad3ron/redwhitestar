<?php

namespace App\Http\Requests\Edp;

use Illuminate\Foundation\Http\FormRequest;

class PerusahaanRequest extends FormRequest
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
            'name' => 'required|string|min:2|unique:perusahaans',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Nama Perusahaan harus di isi',
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'Nama perusahaan',
        ];
    }
}

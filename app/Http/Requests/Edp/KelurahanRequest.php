<?php

namespace App\Http\Requests\Edp;

use Illuminate\Foundation\Http\FormRequest;

class KelurahanRequest extends FormRequest
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
            'name' => 'required|min:3',
            'kecamatan' => 'required|string|max:255',
            'dapil' => 'required|string|max:255',
            'kabkota' => 'required|string|max:255',
            'provinsi' => 'required|string|max:255',
            'kodepos' => 'required|string|max:10',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Nama Kelurahan harus di isi',
            'kecamatan.required' => 'Nama kecamatan harus di isi',
            'dapil.required' => 'Nama Dapil harus di isi',
            'kabkota.required' => 'Nama Kabupaten / Kota harus di isi',
            'provinsi.required' => 'Nama Provinsi harus di isi',
            'kodepos.required' => 'Nama Kodepos harus di isi',
        ];
    }
}

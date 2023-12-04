<?php

namespace App\Http\Requests\Hrd;

use Illuminate\Foundation\Http\FormRequest;

class BiodataRequest extends FormRequest
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
        $id = $this->biodata ? $this->biodata->id : '';
        return [
            'nik' => 'required|string|min:16|unique:biodatas,nik,'.$id,
            'nokk' => 'required|string|min:16',
            'nama' => 'required|string|max:255',
            'kotalahir_id' => 'required|integer|exists:kotalahirs,id',
            'tgl_lahir' => 'required|date',
            'status' => 'required|in:Nikah,Lajang,Duda,Janda',
            'agama' => 'required|string|max:255',
            'jenis' => 'required|in:Laki-laki,Perempuan',
            'alamat' => 'required|string|max:255',
            'rt' => 'required|string|max:3',
            'rw' => 'required|string|max:3',
            'kelurahan_id' => 'required|integer|exists:kelurahans,id',
            'phone' => 'required|string|min:10',
            'is_visible' => 'required|in:Active,Inactive,Disable',
        ];
    }

    // public function messages()
    // {
    //     return [
    //         'nik.required' => 'NIK tidak boleh kosong.',
    //         'nik.min' => 'NIK harus terdiri dari 16 karakter.',
    //         'nik.unique' => 'NIK sudah digunakan, silahkan masukkan NIK yang lain',
    //     ];
    // }
}

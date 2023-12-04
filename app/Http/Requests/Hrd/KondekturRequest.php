<?php

namespace App\Http\Requests\Hrd;

use Illuminate\Foundation\Http\FormRequest;

class KondekturRequest extends FormRequest
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
            'biodata_id' => 'required|integer|exists:biodatas,id',
            'nokondektur' => 'required|string|min:6',
            'rute_id' => 'required|integer|exists:rutes,id',
            'tgl_kp' => 'required|date',
            'nojamsostek' => 'required|string|max:16',
            'tgl_jamsos' => 'required|date',
            'status' => 'required|in:belum,nikah,cerai',
            'tgl_keluar' => 'required|date',
            'keterangan' => 'required|string|max:255',
        ];
    }

    public function messages()
    {
        return [
            'nokondektur.required' => 'NIK tidak boleh kosong.',
            'nokondektur.min' => 'NIK harus terdiri dari 6 karakter.',
            'nokondektur.unique' => 'NIK sudah digunakan, silahkan masukkan NIK yang lain',
        ];
    }
}

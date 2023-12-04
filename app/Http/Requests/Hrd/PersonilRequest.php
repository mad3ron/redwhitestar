<?php

namespace App\Http\Requests\Hrd;

use Illuminate\Foundation\Http\FormRequest;

class PersonilRequest extends FormRequest
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
            'jabatan_id' => 'required|integer|exists:jabatans,id',
            'rute_id' => 'required|integer|exists:rutes,id',
            'noinduk' => 'required|string|min:6',
            'tgl_kp' => 'required|date',
            'nosim' => 'required|string|min:12',
            'jenis_sim' => 'required|string|min:2',
            'tgl_sim' => 'required|date',
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
            'biodata_id.required' => 'Biodata_id tidak boleh kosong.',
            'biodata_id.min' => 'Biodata_id harus terdiri dari 6 karakter.',
            'biodata_id.unique' => 'Biodata_id sudah digunakan !!',
        ];
    }
}

<?php

namespace App\Http\Requests\Hrd;

use Illuminate\Foundation\Http\FormRequest;

class PengemudiRequest extends FormRequest
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
            'nopengemudi' => 'required|string|min:6',
            'rute_id' => 'required|integer|exists:rutes,id',
            'tgl_kp' => 'required|date',
            'nosim' => 'required|string|min:12',
            'jenis_sim' => 'required|string|min:2',
            'tgl_sim' => 'required|date',
            'nojamsostek' => 'nullable',
            'tgl_jamsos' => 'nullable',
            'keterangan' => 'nullable',
        ];
    }

    public function messages()
    {
        return [
            'nopengemudi.required' => 'No.Induk Pengemudi tidak boleh kosong.',
            'nopengemudi.min' => 'No.Induk Pengemudi harus terdiri dari 6 karakter.',
            'nopengemudi.unique' => 'No.Induk Pengemudi sudah digunakan !!',
        ];
    }
}

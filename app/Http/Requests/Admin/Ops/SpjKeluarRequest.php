<?php

namespace App\Http\Requests\Ops;

use App\Models\Ops\SpjKeluar;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SpjKeluarRequest extends FormRequest
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
        // mendapatkan nomor spj terakhir
        $lastSpj = SpjKeluar::max('nospj');

        // memecah nomor spj terakhir menjadi kode posisi dan nomor urut
        $lastPosisi = substr($lastSpj, 0, 2);
        $lastNoUrut = substr($lastSpj, 2, 6);

        // menentukan kode posisi dan nomor urut untuk nomor spj baru
        $newPosisi = '01';
        $newNoUrut = str_pad($lastNoUrut + 1, 6, '0', STR_PAD_LEFT);

        // menggabungkan kode posisi, tanggal, dan nomor urut menjadi nomor spj baru
        $today = now()->format('ymd');
        $newSpj = $newPosisi.$today.'.'.$newNoUrut;

        return [
            'nospj' => [
                'required',
                'string',
                Rule::unique('spj_keluars')->ignore($this->id),
                Rule::in([$newSpj]),
            ],
            'id' => [
                'required',
                Rule::unique('spj_keluars')->ignore($this->id),
                'regex:/^\d{2}\.\d{2}[0-1][0-9]\.\d{6}$/',
            ],
            'tgl_keluar' => 'required|date',
            'jam_klr' => 'required|time',
            'posisi_id' => 'required|integer|exists:posisis,id',
            'bis_id' => 'required|integer|exists:bis,id',
            'nopolisi' => 'required|string',
            'rute_id' => 'required|integer|exists:rutes,id',
            'pool_id' => 'required|integer|exists:pools,id',
            'pengemudi_id' => 'required|integer|exists:pengemudi,id',
            'kondektur_id' => 'required|integer|exists:kondektur,id',
            'keterangan' => 'required|string',
            'personil_id' => 'required|integer|exists:personil,id',
        ];
    }
}

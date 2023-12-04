<?php

namespace App\Http\Requests\Edp;

use Illuminate\Foundation\Http\FormRequest;

class BisRequest extends FormRequest
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
        $id = $this->biss ? $this->biss->id : '';
        return [
        'nobody' => 'required|string|max:25|unique:bis,nobody,'.$id,
        'nopolisi' => 'required|string|max:255',
        'nochassis' => 'required|string|max:255|unique:bis,nochassis,'.$id,
        'nomesin' => 'required|string|max:255|unique:bis,nomesin,'.$id,
        'rute_id' => 'required|integer|exists:rutes,id',
        'pool_id' => 'required|integer|exists:pools,id',
        'merk' => 'required|string|max:255',
        'tahun' => 'required|integer',
        'jenis' => 'required|string|max:255',
        'seat' => 'required|integer',
        'kondisi' => 'required|in:Baik,Sedang,Buruk,Rusak,Upkir',
        'keterangan' => 'nullable|string',
        ];
    }

    // public function messages()
    // {
    //     return [
    //         'rute_id.required' => 'Nama Rute harus diisi',
    //         'nobody.required' => 'Nomor Body harus diisi',
    //     ];
    // }
}

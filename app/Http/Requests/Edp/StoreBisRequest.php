<?php

namespace App\Http\Requests\Edp;

use Illuminate\Foundation\Http\FormRequest;

class StoreBisRequest extends FormRequest
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
            'nobody' => 'required|string|max:25|unique:bis',
            'nopolisi' => 'required|string|max:25',
            'nochassis' => 'required|string|max:255|unique:bis',
            'nomesin' => 'required|string|max:255|unique:bis',
            'rute_id' => 'required|integer|exists:rutes,id',
            'pool_id' => 'required|integer|exists:pools,id',
            'merk' => 'required|string|max:255',
            'tahun' => 'required|integer',
            'jenis' => 'required|string|max:255',
            'seat' => 'required|integer',
            'kondisi' => 'required|in:baik,sedang,buruk,rusak,Upkir',
            'keterangan' => 'required|string|max:255',
        ];
    }
}

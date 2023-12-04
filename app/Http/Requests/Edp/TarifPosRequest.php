<?php

namespace App\Http\Requests\Edp;

use Illuminate\Foundation\Http\FormRequest;

class TarifPosRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules()
    {
        return [
            'rute_id' => 'required',
            'poschecker_id' => 'required',
            'tarif' => 'required',
            'tabri' => 'required',
            'status' => 'required',
            'keterangan' => 'nullable',
        ];
    }

    public function messages()
    {
        return [
            'rute_id.required' => 'The rute field is required.',
            'poschecker_id.required' => 'The poschecker field is required.',
            'kota_id.required' => 'The kota field is required.',
            'tarif.required' => 'The tarif field is required.',
            'tabri.required' => 'The tabri field is required.',
            'status.required' => 'The status field is required.',
        ];
    }
}

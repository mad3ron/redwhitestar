<?php

namespace App\Http\Requests\Thk;

use Illuminate\Foundation\Http\FormRequest;

class BuscheckRequest extends FormRequest
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
    public function rules(): array
    {
        return [
            'tgl_bischeck' => 'required|date',
            'nokar_id' => 'required',
            'bis_id' => 'required|numeric',
            'posisi_id' => 'required|numeric',
            'password' => 'required|string',
            'ket_posisi' => 'required|string',
        ];
    }
}

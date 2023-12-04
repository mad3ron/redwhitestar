<?php

namespace App\Http\Requests\Edp;

use Illuminate\Foundation\Http\FormRequest;

class PoscheckerRequest extends FormRequest
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
            'kodepos' => 'required',
            'namapos' => 'required',
            'wilayah' => 'required|in:Timur,Barat',
            'status'  => 'required|in:Active,Inactive,Disable',
        ];
    }

    // public function messages()
    // {
    //     return [
    //         'kodepos.unique' => 'Kodepos sudah digunakan.',
    //     ];
    // }
}

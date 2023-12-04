<?php

namespace App\Http\Requests\Edp;

use Illuminate\Foundation\Http\FormRequest;

class PoolRequest extends FormRequest
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
            'nama_pool' => 'required|string|min:2|unique:pools',
            'alamat' => 'required|string',
            'phone' => 'required|string',
            'status' => 'required|in:Active,Inactive,Disable',
        ];
    }

    public function messages()
    {
        return [
            'nama_pool.required' => 'Nama Pool harus diisi.',
            'nama_pool.unique' => 'Nama Pool sudah ada.',
            'phone.required' => 'Nomor telepon harus diisi.',
            'status.required' => 'Status harus dipilih.',
            'status.in' => 'Status yang dipilih tidak valid.',
        ];
    }
}

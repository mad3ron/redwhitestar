<?php

namespace App\Http\Requests\Ops;

use Illuminate\Foundation\Http\FormRequest;

class JadwaljamRequest extends FormRequest
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
            'rute_id' => 'required|integer|exists:rutes,id',
            'jamkr' => 'required|string',
            'status' => 'required|in:active,inactive,pending',
            'keterangan' => 'required|string|max:255',
        ];
    }
}

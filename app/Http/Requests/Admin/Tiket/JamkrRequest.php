<?php

namespace App\Http\Requests\Tiket;

use Illuminate\Foundation\Http\FormRequest;

class JamkrRequest extends FormRequest
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
            'jamkr' => 'required|date_format:H:i',
            'status' => 'required|in:active,inactive,pending',
            'keterangankr' => 'required|string|max:255',
        ];
    }
}

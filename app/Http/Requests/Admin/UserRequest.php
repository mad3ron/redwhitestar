<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'username' => 'required|username|unique:users,username,',
            'email' => 'required|email|unique:users,email,',
            'role_id' => 'required|integer|exists:roles,id',
            'status' => 'required|in:active,inactive,disable',
            'password' => 'nullable|string|min:8',
        ];
    }
}

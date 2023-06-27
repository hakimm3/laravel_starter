<?php

namespace App\Http\Requests;

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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,' . $this->id,
            'email' => 'required|string|email|max:255|unique:users,email,' . $this->id,
            'department_id' => 'required|exists:departments,id',
            'photo' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'password' => 'required|string|min:8',
        ];
    }
}

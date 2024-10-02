<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UserEditRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'profile_picture' => 'nullable|string|max:255',
            'username' => 'required|string|min:3|max:255|unique:users,username,' . $this->route('user')->id . ',id',
            'name' => 'required',
            'description' => 'nullable|string|max:255',
            'email' => 'required|email|unique:users,email,' . $this->route('user')->id . ',id',
            'password' => 'nullable|confirmed|min:6',
            'role' => 'required',
            'status' => 'required',
        ];
    }
}

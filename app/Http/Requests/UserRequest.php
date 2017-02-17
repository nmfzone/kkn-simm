<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
        $user = $this->route('user');

        switch ($this->method()) {
            case 'POST':
                return [
                    'username' => 'required|max:255|alpha_dash|unique:users',
                    'name' => 'required|max:255',
                    'password' => 'required|confirmed|min:6',
                    'photo' => 'mimes:png,jpg,gif,jpeg|max:1000',
                ];
            case 'PUT':
            case 'PATCH':
                return [
                    'username' => 'required|alpha_dash|max:255|unique:users,username,' . $user->id,
                    'name' => 'required|max:255',
                    'photo' => 'mimes:png,jpg,gif,jpeg|max:1000',
                ];
        }
    }
}

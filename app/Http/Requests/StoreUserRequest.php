<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            'lastname'     => 'required|string|min:2',
            'firstname'    => 'required|string|min:2',
            'role'         => 'required|in:admin,user',
            'email'        => 'required|email|unique:users',
            'phone_number' => 'required|string|min:10|max:10',
            'password'     => 'required|string|min:6',
            'sociale_id'   => '',
        ];
    }
}

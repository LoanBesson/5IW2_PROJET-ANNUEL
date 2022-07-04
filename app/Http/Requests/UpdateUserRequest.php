<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
            'lastname'     => 'string|min:2',
            'firstname'    => 'string|min:2',
            'role'         => 'in:admin,user',
            'email'        => 'email|unique:users,email,'.$this->id,
            'phone_number' => 'string|min:10|max:10',
            'password'     => 'string|min:6',
            'sociale_id'   => '',
        ];
    }
}

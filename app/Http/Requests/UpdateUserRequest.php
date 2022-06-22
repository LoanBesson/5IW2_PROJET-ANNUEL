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
        return false;
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
            'phone_number' => 'required|string|min:10|max:10',
            'password'     => 'sometimes|required|string|min:6',
            'sociale_id'   => '',
        ];
    }
}

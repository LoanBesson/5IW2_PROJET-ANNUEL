<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSearchRequest extends FormRequest
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
            "type"      => "in:appartment,house",
            "category"  => "in:T1,T2,T3,T4,T5,T6,T7,T8,T9",
            "city"      => "string",
            "min_price" => "numeric|min:0",
            "max_price" => "numeric|gte:min_price",
        ];
    }
}

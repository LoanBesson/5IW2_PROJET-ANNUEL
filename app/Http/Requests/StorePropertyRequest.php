<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class StorePropertyRequest extends FormRequest
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
            "user_id"               => 'required|exists:users,id',
            "title"                 => 'required|string|min:5|max:50',
            "description"           => 'required|string|min:5|max:255',
            "type"                  => [
                                        'required',
                                        Rule::in(['appartment', 'house']),
                                        ],
            "category"              => [
                                        'required',
                                        Rule::in(['T1', 'T2', 'T3', 'T4', 'T5', 'T6', 'T7', 'T8', 'T9']),
                                        ],
            "area"                  => 'required|numeric|min:1',
            "floor"                 => 'required|integer|min:0',
            "floors"                => 'required|integer|min:1',
            "rooms"                 => 'required|integer|min:1',
            "bedrooms"              => 'required|integer|min:0',
            "bathrooms"             => 'required|integer|min:0',
            "toilets"               => 'required|integer|min:0',
            "is_furnished"          => 'required|boolean',
            "contains_storage"      => 'required|boolean',
            "is_kitchen_separated"  => 'required|boolean',
            "contains_dining_room"  => 'required|boolean',
            "ground"                => [
                                        'required',
                                        Rule::in(['wood', 'rock']),
                                        ],
            "heater"                => [
                                        'required',
                                        Rule::in(['electrical', 'gas']),
                                        ],
            "fireplace"             => 'required|boolean',
            "elevator"              => 'required|boolean',
            "external_storage"      => 'required|boolean',
            "area_external_storage" => 'required|numeric|min:0',
            "guarding"              => 'required|boolean',
            "energy_consumption"    => 'required|integer|min:0',
            "gas_emissions"         => 'required|integer|min:0',
            "address"               => 'required|string',
            "zip_code"              => 'required|integer|min:1000|max:96000',
            "city"                  => 'required|string',
            "rentOrSale"            => [
                                        'required',
                                        Rule::in(['rent', 'sale'])
                                        ],
            "price"                 => 'required|numeric|min:1',
            "charges"               => 'required|numeric|min:0',
            "guarentee"             => 'required|numeric|min:0',
            "fees_price"            => 'required|numeric|min:0',
            "inventory_price"       => 'required|numeric|min:0',
            "published"             => 'required|boolean',
            "image_path"            => 'required|string',
            "construction_date"     => 'required|date|before:now'
        ];
    }
}

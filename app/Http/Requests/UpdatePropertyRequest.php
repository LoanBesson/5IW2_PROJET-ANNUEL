<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePropertyRequest extends FormRequest
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
            "title"                 => 'string|min:5|max:50',
            "description"           => 'string|min:5|max:255',
            "type"                  => [
                                        Rule::in(['appartment', 'house']),
                                        ],
            "category"              => [
    
                                        Rule::in(['T1', 'T2', 'T3', 'T4', 'T5', 'T6', 'T7', 'T8', 'T9']),
                                        ],
            "area"                  => 'numeric|min:1',
            "floor"                 => 'integer|min:0',
            "floors"                => 'integer|min:1',
            "rooms"                 => 'integer|min:1',
            "bedrooms"              => 'integer|min:0',
            "bathrooms"             => 'integer|min:0',
            "toilets"               => 'integer|min:0',
            "is_furnished"          => 'boolean',
            "contains_storage"      => 'boolean',
            "is_kitchen_separated"  => 'boolean',
            "contains_dining_room"  => 'boolean',
            "ground"                => [
                                        Rule::in(['wood', 'rock']),
                                        ],
            "heater"                => [
                                        Rule::in(['electrical', 'gas']),
                                        ],
            "fireplace"             => 'boolean',
            "elevator"              => 'boolean',
            "external_storage"      => 'boolean',
            "area_external_storage" => 'numeric|min:0',
            "guarding"              => 'boolean',
            "energy_consumption"    => 'integer|min:0',
            "gas_emissions"         => 'integer|min:0',
            "address"               => 'string',
            "zip_code"              => 'integer|min:1000|max:96000',
            "city"                  => 'string',
            "rentOrSale"            => [
                                        Rule::in(['rent', 'sale'])
                                        ],
            "price"                 => 'numeric|min:1',
            "charges"               => 'numeric|min:0',
            "guarentee"             => 'numeric|min:0',
            "fees_price"            => 'numeric|min:0',
            "inventory_price"       => 'numeric|min:0',
            "published"             => 'boolean',
            "image_path"            => 'string',
            "construction_date"     => 'date|before:now'
        ];
    }
}

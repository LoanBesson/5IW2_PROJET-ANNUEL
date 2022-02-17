<?php

namespace App\Http\Requests;

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
            "user_id"               => 'required',
            "title"                 => 'required|string|min:5|max:50',
            "description"           => 'required|string|min:5|max:255',
            "type"                  => 'required',
            "category"              => 'required',
            "area"                  => 'required',
            "floor"                 => 'required',
            "floors"                => 'required',
            "rooms"                 => 'required',
            "bedrooms"              => 'required',
            "bathrooms"             => 'required',
            "toilets"               => 'required',
            "is_furnished"          => 'required',
            "contains_storage"      => 'required',
            "is_kitchen_separated"  => 'required',
            "contains_dining_room"  => 'required',
            "ground"                => 'required',
            "heater"                => 'required',
            "fireplace"             => 'required',
            "elevator"              => 'required',
            "external_storage"      => 'required',
            "area_external_storage" => 'required',
            "guarding"              => 'required',
            "energy_consumption"    => 'required',
            "gas_emissions"         => 'required',
            "address"               => 'required',
            "zip_code"              => 'required',
            "city"                  => 'required',
            "rentOrSale"            => 'required',
            "price"                 => 'required',
            "charges"               => 'required',
            "guarentee"             => 'required',
            "fees_price"            => 'required',
            "inventory_price"       => 'required',
            "published"             => 'required',
            "image_path"            => 'required',
            "construction_date"     => 'required|date|before:now'
        ];
    }
}

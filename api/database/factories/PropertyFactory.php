<?php

namespace Database\Factories;

use App\Models\Property;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Property>
 */
class PropertyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Property::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $types = ['appartment', 'house'];
        $type = array_rand($types);

        $categories = ['T1', 'T2', 'T3', 'T4', 'T5', 'T6', 'T7', 'T8', 'T9'];
        $category = array_rand($categories);

        $grounds = ['wood', 'rock'];
        $ground = array_rand($grounds);

        $heaters = ['electrical', 'gas'];
        $heater = array_rand($heaters);

        $rentOrSales = ['rent', 'sale'];
        $rentOrSale = array_rand($rentOrSales);

        return [
            "title"                 => $this->faker->text(25),
            "description"           => $this->faker->realText(),
            "type"                  => $types[$type],
            "category"              => $categories[$category],
            "area"                  => $this->faker->randomFloat(2,1,200),
            "floor"                 => random_int(0,2),
            "floors"                => random_int(1,2),
            "rooms"                 => random_int(1,6),
            "bedrooms"              => random_int(0,2),
            "bathrooms"             => random_int(0,2),
            "toilets"               => random_int(0,2),
            "is_furnished"          => random_int(0,1),
            "contains_storage"      => random_int(0,1),
            "is_kitchen_separated"  => random_int(0,1),
            "contains_dining_room"  => random_int(0,1),
            "ground"                => $grounds[$ground],
            "heater"                => $heaters[$heater],
            "fireplace"             => random_int(0,1),
            "elevator"              => random_int(0,1),
            "external_storage"      => random_int(0,1),
            "area_external_storage" => $this->faker->randomFloat(2, 0, 10),
            "guarding"              => random_int(0,1),
            "energy_consumption"    => random_int(0,500),
            "gas_emissions"         => random_int(0,500),
            "address"               => $this->faker->address(),
            "zip_code"              => intval(str_replace(' ', '', $this->faker->postcode())),
            "city"                  => $this->faker->city(),
            "rentOrSale"            => $rentOrSales[$rentOrSale],
            "price"                 => random_int(55000,500000),
            "charges"               => $this->faker->randomFloat(2,0,1000),
            "guarentee"             => $this->faker->randomFloat(2,0,3000),
            "fees_price"            => $this->faker->randomFloat(2,0,300),
            "inventory_price"       => $this->faker->randomFloat(2,0,300),
            "published"             => random_int(0,1),
            "image_path"            => '',
            "construction_date"     => $this->faker->date()
        ];
    }
}

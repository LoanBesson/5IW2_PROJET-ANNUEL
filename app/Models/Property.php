<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Property extends Model
{
    use HasFactory;
    use Searchable;

    // protected $casts = [
    //     'price' => 'float',
    //     'charges' => 'float',
    // ];


    public function shouldBeSearchable()
    {
        return $this->published === true;
    }

    /**
     * Get the indexable data array for the model.
     *
     * @return array
     */
    public function toSearchableArray()
    {
        $array = $this->toArray();

        return $array;
    }

    protected $fillable = [
        "title",
        "description",
        "type",
        "category",
        "area",
        "floor",
        "floors",
        "rooms",
        "bedrooms",
        "bathrooms",
        "toilets",
        "is_furnished",
        "contains_storage",
        "is_kitchen_separated",
        "contains_dining_room",
        "ground",
        "heater",
        "fireplace",
        "elevator",
        "external_storage",
        "area_external_storage",
        "guarding",
        "energy_consumption",
        "gas_emissions",
        "address",
        "zip_code",
        "city",
        "rentOrSale",
        "price",
        "charges",
        "guarentee",
        "fees_price",
        "inventory_price",
        "published",
        "image_path",
        "construction_date",
        "user_id"
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function contacts()
    {
        return $this->hasMany(Contact::class);
    }
}

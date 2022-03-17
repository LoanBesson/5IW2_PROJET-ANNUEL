<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'property_id',
        'prospect_id',
        'desired_date',
        'status'
    ];

    public function prospect()
    {
        return $this->belongsTo(User::class, 'prospect_id', 'id');
    }

    public function property()
    {
        return $this->belongsTo(Property::class);
    }
}

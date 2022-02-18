<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Search extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'category',
        'city',
        'min_price',
        'max_price',
        'searcher'
    ];

    public function searcher()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}

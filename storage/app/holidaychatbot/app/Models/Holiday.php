<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Holiday extends Model
{
    /**
     * Fields that are mass assignable
     *
     * @var array
     */
    protected $fillable = [
        'HotelName',
        'City',
        'Continent',
        'Country',
        'Category',
        'StarRating',
        'TempRating',
        'Location',
        'PricePerNight',
        'Weight'
    ];
}

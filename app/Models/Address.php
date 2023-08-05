<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Property;

class Address extends Model
{
    use HasFactory;

    protected $fillable = [
        'street_and_number',
        'city',
        'country_id',
        'zip_code'
    ];
    public function properties()
    {
        return $this->hasMany(Property::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }


}

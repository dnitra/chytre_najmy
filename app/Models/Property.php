<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Property extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'property_type_id',
        'address_id',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsToMany(User::class);

    }
    public function address()
    {
        return $this->belongsTo(Address::class);
    }

    public function propertyType()
    {
        return $this->belongsTo(PropertyType::class);
    }

}

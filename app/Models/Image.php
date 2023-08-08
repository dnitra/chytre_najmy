<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ImageCategory;
use App\Models\Property;

class Image extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'rented_property_id',
        'image_category_id',
        'image_path',
    ];

    public function property()
    {
        return $this->belongsTo(Property::class);
    }

    public function imageCategory()
    {
        return $this->belongsTo(ImageCategory::class);
    }

    public function getImagePathAttribute($value)
    {
        return asset('storage/' . $value);
    }
}

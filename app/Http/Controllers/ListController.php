<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\PropertyType;
use App\Models\Country;

class ListController extends Controller
{
    public function listAllPropertyTypes()
    {
        $propertyTypes = PropertyType::all();
        return Inertia::render('Lists/PropertyTypes', [
            'propertyTypes' => $propertyTypes
        ]);
    }
    public function listAllCountries()
    {
        $countries = Country::all();
        return Inertia::render('Lists/Countries', [
            'countries' => $countries
        ]);
    }

}

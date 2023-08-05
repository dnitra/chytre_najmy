<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\PropertyType;
use App\Models\Country;
use Illuminate\Support\Facades\Auth;
use App\Models\Address;

class PropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('OwnerPortal/MyProperties/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        $address = Address::create($request->validate([
            'city' => 'required|string|max:60',
            'country_id' => 'required|integer',
            'street_and_number' => 'required|string|max:60',
            'zip_code' => 'required|integer|digits:5',
        ]));
        $property = new Property($request->validate([
            'property_type_id' => 'required|integer',
        ]));
        $property->address_id = $address->id;
        try {
            $property->save();
            $user->properties()->attach($property->id);

        } catch (\Throwable $th) {
            session()->flash('error', 'There was an error creating the property.');
            return redirect()->back();
        }
        try {
            $user->last_visited_property_id = $property->id;
            $user->save();
        } catch (\Throwable $th) {
            session()->flash('error', 'Something went wrong.');
        }
        session()->flash('success', 'Property created successfully.');
        return redirect()->route('my-properties.show', $property->id);
    }

    /**
     * Display the specified resource.
     */
    public function show(Property $property, $id)
    {
        $user = Auth::user();
        try {
            $property = $user->properties()->findOrfail($id)->load('propertyType')->load('address');
        } catch (\Throwable $th) {
            $property = null;
            session()->flash('error', 'You do not have access to that property.');
            return redirect()->back();
        }
        if($property){
            $user->last_visited_property_id = $property->id;
            $user->save();
        }
        return Inertia::render('OwnerPortal/MyProperties/Show', [
            'property' => $property,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Property $property)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Property $property)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Property $property)
    {
        //
    }
}

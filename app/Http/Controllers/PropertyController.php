<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\PropertyType;
use App\Models\Country;
use Illuminate\Support\Facades\Auth;

class PropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
//        $user = Auth::user();
//        $properties = $user->properties;
        $properties=["name"=>"test name", "address"=>"test address"];

        return Inertia::render('OwnerPortal/MyProperties', [
            'properties' => $properties,
            'lastVisitedProperty' => 2
        ]);
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Property $property, $id)
    {
        $properties = ["name" => "test name", "address" => "test address"];

        $id = $id;

        return Inertia::render('OwnerPortal/MyProperties/Show', [
            'properties' => $properties,
            'id' => $id,
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

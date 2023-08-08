<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Image;

class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($category, $id)
    {
        //list all images for a given category and property
        $images = Image::where('image_category_id', $category)
            ->where('rented_property_id', $id)
            ->select('image_path', 'name')
            ->get();

        return response()->json([
            'success' => true,
            'data' => $images
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $propertyId = $request->propertyId;
        $category = $request->category;

        return response()->json(
            [
                'success' => true,
                'data' => [
                    'category' => $category,
                    'propertyId' => $propertyId
                ]
            ]
        );

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'image_category_id' => 'required',
            'rented_property_id' => 'required',
            'image_data' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $image = $request->file('image_data');
        $imageName = time() . '.' . $image->extension();
        $path = "images/properties/" .
            $request->rented_property_id . "/" .
            $request->image_category_id . "/" .
            $imageName;
        $image->storeAs("public", $path);

        $image = Image::create([
            'name' => $request->name,
            'description' => $request->description,
            'rented_property_id' => $request->rented_property_id,
            'image_category_id' => $request->image_category_id,
            'image_path' => $path,
        ]);

        return response()->json([
            'success' => true,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        //display a single image
        $image = Image::where('id', $request->id)
            ->select('image_path', 'name')
            ->get();
        return response()->json([
            'success' => true,
               'data' => $image
        ]);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

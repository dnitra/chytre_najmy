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
    public function index($propertyId, $categoryId)
    {
        //list all images for a given category and property
        $images = Image::where('image_category_id', $categoryId)
            ->where('property_id', $propertyId)
            ->select('image_path', 'name')
            ->get();

        return Inertia::render('Shared/Image/Index', [
            'images' => $images,
            'categoryId' => $categoryId,
            'propertyId' => $propertyId,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($propertyId, $categoryId){

        return Inertia::render('Shared/Image/Create', [
            'propertyId' => $propertyId,
            'categoryId' => $categoryId
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'categoryId' => 'required',
            'propertyId' => 'required',
            'imageData' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $image = $request->file('image_data');
        $imageName = time() . '.' . $image->extension();
        $path = "images/properties/" .
            $request->propertyId . "/" .
            $request->categoryId . "/" .
            $imageName;
        $image->storeAs("public", $path);

        $image = Image::create([
            'name' => $request->name,
            'description' => $request->description,
            'property_id' => $request->propertyId,
            'image_category_id' => $request->categoryId,
            'image_path' => $path,
        ]);

        return Inertia::render('Shared/Image/Index', [
            'image_category_id' => $request->categoryId,
            'propertyId' => $request->propertyId
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show($propertyId, $categoryId, $imageId)
    {
        $image = Image::where('id', $imageId)
            ->where('image_category_id', $categoryId)
            ->where('property_id', $propertyId)
            ->select('image_path', 'name')
            ->get();
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($propertyId, $categoryId, $imageId)
    {
        $image = Image::where('id', $imageId)
            ->where('image_category_id', $categoryId)
            ->where('property_id', $propertyId)
            ->select('image_path', 'name')
            ->get();

        return Inertia::render('Shared/Image/Edit', [
            'image' => $image,
            'propertyId' => $propertyId,
            'categoryId' => $categoryId
        ]);

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

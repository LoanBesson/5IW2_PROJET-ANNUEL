<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\PropertyResource;
use App\Http\Requests\StorePropertyRequest;
use App\Http\Requests\UpdatePropertyRequest;

class PropertyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api')->except('index', 'show');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return PropertyResource::collection(Property::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePropertyRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePropertyRequest $request)
    {
        $property = Auth::user()->properties()->create($request->all());

        if ($request->hasFile('image_path')) {
            $image = $request->file('image_path')->getClientOriginalName();
            $extension = $request->file('image_path')->getClientOriginalExtension();
            $fileNameToStore = str_replace(' ', '_', $image) . '_' . time() . '.' . $extension;

            $property->image_path = $request->file('image_path')->storeAs('public/images', $fileNameToStore);
            $property->save();
        }

        return response()->json([
            'message' => 'Property added successfully!',
            'data' => new PropertyResource($property)
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Property  $property
     * @return \Illuminate\Http\Response
     */
    public function show(Property $property)
    {
        return response()->json([
            'data' => [
                new PropertyResource($property),
                'imgUrl' => Storage::url($property->image_path),
                ]
        ], 201);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePropertyRequest  $request
     * @param  \App\Models\Property  $property
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePropertyRequest $request, Property $property)
    {
        if (Gate::denies('access-property', $property))
            return response()->json(['error' => 'You are not authorized to update this property.'], 403);

        $property->update($request->all());

        return response()->json([
            'message' => 'Property updated successfully!',
            'data' => new PropertyResource($property)
        ], 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Property  $property
     * @return \Illuminate\Http\Response
     */
    public function destroy(Property $property)
    {
        if (Gate::denies('access-property', $property))
            return response()->json(['error' => 'You are not authorized to delete this property.'], 403);

        $property->delete();

        return response('', 204);
    }
}

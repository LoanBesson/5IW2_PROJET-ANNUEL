<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePropertyRequest;
use App\Http\Requests\UpdatePropertyRequest;
use App\Http\Resources\PropertyResource;
use Illuminate\Http\Request;
use App\Models\Property;

class PropertyController extends Controller
{
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
    public function store(Request $request)
    {
        $property = Property::create($request->all());

        if($request->hasFile('image_path')) {
            $completeFileName = $request->file('image_path')->getClientOriginalName();
            $fileName = pathinfo($completeFileName, PATHINFO_FILENAME);
            $extension = $request->file('image_path')->getClientOriginalExtension();
            $fileNameToStore = str_replace(' ', '_', $fileName) . '_' . time() . '.' . $extension;
            $path = $request->file('image_path')->storeAs('public/images', $fileNameToStore);
            $property->image_path = $fileNameToStore;
            if($property->save()) {
                return response()->json(['success' => true, 'message' => 'File uploaded successfully.']);
            } else {
                return response()->json(['success' => false, 'message' => 'File upload failed.']);
            }
        }
        return response()->json([
            'message' => 'Successfully registered!',
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
        return new PropertyResource($property);
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
        $property->update($request->all());

        return response()->json([
            'message' => 'Successfully updated!',
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
        $property->delete();

        return response('', 204);
    }
}

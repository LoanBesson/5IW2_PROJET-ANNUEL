<?php

namespace App\Http\Controllers;

use App\Models\Search;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Http\Resources\SearchResource;
use App\Http\Requests\StoreSearchRequest;
use App\Http\Requests\UpdateSearchRequest;
use Illuminate\Http\Request;
use App\Models\Property;
use App\Http\Resources\PropertyResource;

class SearchController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

 
    public function index(Request $request)
    {
        
       $result = null;
       if($query = $request->get('query'))
       {
        $result = Property::search($query)->paginate(5);
        return PropertyResource::collection($result);
       }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreSearchRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSearchRequest $request)
    {
        $search = Auth::user()->searches()->create($request->all());

        return response()->json([
            'message' => 'Search added successfully!',
            'data' => new SearchResource($search)
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Search  $search
     * @return \Illuminate\Http\Response
     */
    public function show(Search $search)
    {
        if (Gate::denies('access-search', $search))
            return response()->json(['error', 'You are not authorized to show this search.'], 403);

        return new SearchResource($search);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSearchRequest  $request
     * @param  \App\Models\Search  $search
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSearchRequest $request, Search $search)
    {
        if (Gate::denies('access-search', $search))
            return response()->json(['error', 'You are not authorized to update this search.'], 403);

        $search->update($request->all());

        return response()->json([
            'message' => 'Search updated successfully!',
            'data' => new SearchResource($search)
        ], 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Search  $search
     * @return \Illuminate\Http\Response
     */
    public function destroy(Search $search)
    {
        if (Gate::denies('access-search', $search))
            return response()->json(['error', 'You are not authorized to delete this search.'], 403);

        $search->delete();

        return response('', 204);
    }
}

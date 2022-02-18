<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSearchRequest;
use App\Http\Requests\UpdateSearchRequest;
use App\Http\Resources\SearchResource;
use App\Models\Search;

class SearchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return SearchResource::collection(Search::all());
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreSearchRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSearchRequest $request)
    {
        $search = Search::create($request->all());

        return response()->json([
            'message' => 'Successfully registered!',
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
        $search->update($request->all());

        return response()->json([
            'message' => 'Successfully updated!',
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
        $search->delete();

        return response('', 204);
    }
}

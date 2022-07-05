<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Http\Resources\FavoriteResource;
use App\Http\Requests\StoreFavoriteRequest;

class FavoriteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Gate::denies('isAdmin'))
            return response()->json(['error' => 'You are not authorized to show all favorites.'], 403);

        return FavoriteResource::collection(Auth::user()->favorites);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreFavoriteRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFavoriteRequest $request)
    {
        $favorite = Auth::user()->favorites->where('property_id', $request->property_id)->first();

        if ($favorite)
            return response()->json(['message' => 'You have already favorited this property'], 400);

        $favorite = Auth::user()->favorites()->create($request->all());

        return response()->json([
            'message' => 'Favorite added successfully',
            'data' => new FavoriteResource($favorite)
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Favorite  $favorite
     * @return \Illuminate\Http\Response
     */
    public function show(Favorite $favorite)
    {
        if (Gate::denies('access-favorite', $favorite))
            return response()->json(['error' => 'You are not authorized to view this favorite.'], 403);

        return new FavoriteResource($favorite);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Favorite  $favorite
     * @return \Illuminate\Http\Response
     */
    public function destroy(Favorite $favorite)
    {
        if (Gate::denies('access-favorite', $favorite))
            return response()->json(['error' => 'You are not authorized to delete this favorite.'], 403);

        $favorite->delete();

        return response('', 204);
    }
}

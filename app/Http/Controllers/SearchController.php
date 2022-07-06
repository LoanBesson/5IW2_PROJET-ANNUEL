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
        $this->middleware('auth:api')->except('index');
    }

 /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $result = Property::search($query = '', function ($meilisearch, $query, $options) use ($request) {
            if ($request->has('rentOrSale')) {
                $options['filter'] = 'rentOrSale =' . $request->rentOrSale;
            }
            if ($request->has('type')) {
                $options['filter'] = 'type =' . $request->type;
            }
            if ($request->has('category')) {
                $options['filter'] = 'category =' . $request->category;
            }
            if ($request->has('area')) {
                $options['filter'] = 'area >' . $request->area;
            }
            if ($request->has('city')) {
                $options['filter'] = 'city =' . $request->city;
            }
            //if rentOrSale and type are set
            if ($request->has('rentOrSale') && $request->has('type')) {
                $options['filter'] = 'rentOrSale =' . $request->rentOrSale . ' AND type =' . $request->type;
            }
            //if rentOrSale and category are set
            if ($request->has('rentOrSale') && $request->has('category')) {
                $options['filter'] = 'rentOrSale =' . $request->rentOrSale . ' AND category =' . $request->category;
            }
            //if rentOrSale and area are set
            if ($request->has('rentOrSale') && $request->has('area')) {
                $options['filter'] = 'rentOrSale =' . $request->rentOrSale . ' AND area >' . $request->area;
            }
            //if rentOrSale and city are set
            if ($request->has('rentOrSale') && $request->has('city')) {
                $options['filter'] = 'rentOrSale =' . $request->rentOrSale . ' AND city =' . $request->city;
            }
            //if type and category are set
            if ($request->has('type') && $request->has('category')) {
                $options['filter'] = 'type =' . $request->type . ' AND category =' . $request->category;
            }
            //if type and area are set
            if ($request->has('type') && $request->has('area')) {
                $options['filter'] = 'type =' . $request->type . ' AND area >' . $request->area;
            }
            //if type and city are set
            if ($request->has('type') && $request->has('city')) {
                $options['filter'] = 'type =' . $request->type . ' AND city =' . $request->city;
            }
            //if category and area are set
            if ($request->has('category') && $request->has('area')) {
                $options['filter'] = 'category =' . $request->category . ' AND area >' . $request->area;
            }
            //if category and city are set
            if ($request->has('category') && $request->has('city')) {
                $options['filter'] = 'category =' . $request->category . ' AND city =' . $request->city;
            }
            //if area and city are set
            if ($request->has('area') && $request->has('city')) {
                $options['filter'] = 'area >' . $request->area . ' AND city =' . $request->city;
            }
            //if rentOrSale, type, category are set
            if ($request->has('rentOrSale') && $request->has('type') && $request->has('category')) {
                $options['filter'] = 'rentOrSale =' . $request->rentOrSale . ' AND type =' . $request->type . ' AND category =' . $request->category;
            }
            //if rentOrSale, type, area are set
            if ($request->has('rentOrSale') && $request->has('type') && $request->has('area')) {
                $options['filter'] = 'rentOrSale =' . $request->rentOrSale . ' AND type >' . $request->type . ' AND area >' . $request->area;
            }
            //if rentOrSale, type, city are set
            if ($request->has('rentOrSale') && $request->has('type') && $request->has('city')) {
                $options['filter'] = 'rentOrSale =' . $request->rentOrSale . ' AND type =' . $request->type . ' AND city =' . $request->city;
            }
            //if rentOrSale, category, area are set
            if ($request->has('rentOrSale') && $request->has('category') && $request->has('area')) {
                $options['filter'] = 'rentOrSale =' . $request->rentOrSale . ' AND category =' . $request->category . ' AND area >' . $request->area;
            }
            //if rentOrSale, category, city are set
            if ($request->has('rentOrSale') && $request->has('category') && $request->has('city')) {
                $options['filter'] = 'rentOrSale =' . $request->rentOrSale . ' AND category =' . $request->category . ' AND city =' . $request->city;
            }
            //if rentOrSale, area, city are set
            if ($request->has('rentOrSale') && $request->has('area') && $request->has('city')) {
                $options['filter'] = 'rentOrSale =' . $request->rentOrSale . ' AND area >' . $request->area . ' AND city =' . $request->city;
            }
            //if type, category, area are set
            if ($request->has('type') && $request->has('category') && $request->has('area')) {
                $options['filter'] = 'type =' . $request->type . ' AND category =' . $request->category . ' AND area >' . $request->area;
            }
            //if type, category, city are set
            if ($request->has('type') && $request->has('category') && $request->has('city')) {
                $options['filter'] = 'type =' . $request->type . ' AND category =' . $request->category . ' AND city =' . $request->city;
            }
            //if type, area, city are set
            if ($request->has('type') && $request->has('area') && $request->has('city')) {
                $options['filter'] = 'type =' . $request->type . ' AND area >' . $request->area . ' AND city =' . $request->city;
            }
            //if category, area, city are set
            if ($request->has('category') && $request->has('area') && $request->has('city')) {
                $options['filter'] = 'category =' . $request->category . ' AND area >' . $request->area . ' AND city =' . $request->city;
            }
            //if rentOrSale, type, category, area are set
            if ($request->has('rentOrSale') && $request->has('type') && $request->has('category') && $request->has('area')) {
                $options['filter'] = 'rentOrSale =' . $request->rentOrSale . ' AND type =' . $request->type . ' AND category =' . $request->category . ' AND area >' . $request->area;
            }
            //if rentOrSale, type, category, city are set
            if ($request->has('rentOrSale') && $request->has('type') && $request->has('category') && $request->has('city')) {
                $options['filter'] = 'rentOrSale =' . $request->rentOrSale . ' AND type =' . $request->type . ' AND category =' . $request->category . ' AND city =' . $request->city;
            }
            //if rentOrSale, type, area, city are set
            if ($request->has('rentOrSale') && $request->has('type') && $request->has('area') && $request->has('city')) {
                $options['filter'] = 'rentOrSale =' . $request->rentOrSale . ' AND type =' . $request->type . ' AND area >' . $request->area . ' AND city =' . $request->city;
            }
            //if rentOrSale, category, area, city are set
            if ($request->has('rentOrSale') && $request->has('category') && $request->has('area') && $request->has('city')) {
                $options['filter'] = 'rentOrSale =' . $request->rentOrSale . ' AND category =' . $request->category . ' AND area >' . $request->area . ' AND city =' . $request->city;
            }
            //if type, category, area, city are set
            if ($request->has('type') && $request->has('category') && $request->has('area') && $request->has('city')) {
                $options['filter'] = 'type =' . $request->type . ' AND category =' . $request->category . ' AND area >' . $request->area . ' AND city =' . $request->city;
            }
            //if rentOrSale, type, category, area, city are set
            if ($request->has('rentOrSale') && $request->has('type') && $request->has('category') && $request->has('area') && $request->has('city')) {
                $options['filter'] = 'rentOrSale =' . $request->rentOrSale . ' AND type =' . $request->type . ' AND category =' . $request->category . ' AND area >' . $request->area . ' AND city =' . $request->city;
            }

            return $meilisearch->search($query, $options);
        })->get();
        return $result;
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

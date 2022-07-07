<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use App\Http\Resources\SearchResource;
use App\Http\Requests\StoreUserRequest;
use App\Http\Resources\ContactResource;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\FavoriteResource;
use App\Http\Resources\PropertyResource;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:api']);
        $this->middleware('can:isAdmin')->except(['update', 'getContacts', 'getFavorites', 'getProperties', 'getSearches', 'getPropertiesContacts']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return UserResource::collection(User::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {
        $user = User::create($request->all());

        return response()->json([
            'message' => 'User added successfully!',
            'data' => new UserResource($user)
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return new UserResource(User::findOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, $id)
    {
        $request->validate([
            'email' => 'email|unique:users,email,'.$id,
        ]);

        $user = User::findOrFail($id);
        $user->update($request->all());

        return response()->json([
            'message' => 'User updated successfully!',
            'data' => new UserResource($user)
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::findOrFail($id)->delete();

        return response()->json([
            'message' => 'User deleted successfully!'
        ], 200);
    }

    /**
     * Get the user contacts.
     * @param  User  $user
     * @return ContactResource
     */
    public function getContacts(User $user)
    {
        if ($user->id !== auth()->id() && Gate::denies('isAdmin'))
            return response()->json(['message' => 'You are not authorized to view this resource.'], 403);

        return ContactResource::collection($user->contacts);
    }

    /**
     * Get the user contacts where desired_date is passed.
     * @param  User  $user
     * @return SearchResource
     */
    public function getPassedContacts(User $user)
    {
        if ($user->id !== auth()->id() && Gate::denies('isAdmin'))
            return response()->json(['message' => 'You are not authorized to view this resource.'], 403);

        return ContactResource::collection($user->contacts->where('desired_date', '<', date('Y-m-d H:i')));
    }

    /**
     * Get the user favorites.
     * @param  User  $user
     * @return FavoriteResource
     */
    public function getFavorites(User $user)
    {
        if ($user->id !== auth()->id() && Gate::denies('isAdmin'))
            return response()->json(['message' => 'You are not authorized to view this resource.'], 403);

        return FavoriteResource::collection($user->favorites);
    }

    /**
     * Get the user properties.
     * @param  User  $user
     * @return PropertyResource
     */
    public function getProperties(User $user)
    {
        if ($user->id !== auth()->id() && Gate::denies('isAdmin'))
            return response()->json(['message' => 'You are not authorized to view this resource.'], 403);

        return PropertyResource::collection($user->properties);
    }

    /**
     * Get the user properties associated contacts
     * @param  User  $user
     * @return ContactResource
     */
    public function getPropertiesContacts(User $user)
    {
        if ($user->id !== auth()->id() && Gate::denies('isAdmin'))
            return response()->json(['message' => 'You are not authorized to view this resource.'], 403);

        return ContactResource::collection($user->properties->map(function ($property) {
            return $property->contacts;
        })->flatten());
    }

    /**
     * Get the user properties associated contacts where desired_date is passed.
     * @param  User  $user
     * @return SearchResource
     */
    public function getPassedPropertiesContacts(User $user)
    {
        if ($user->id !== auth()->id() && Gate::denies('isAdmin'))
            return response()->json(['message' => 'You are not authorized to view this resource.'], 403);

        return ContactResource::collection($user->properties->map(function ($property) {
            return $property->contacts->where('desired_date', '<', date('Y-m-d H:i'));
        })->flatten());
    }

    /**
     * Get the user searches.
     * @param  User  $user
     * @return SearchResource
     */
    public function getSearches(User $user)
    {
        if ($user->id !== auth()->id() && Gate::denies('isAdmin'))
            return response()->json(['message' => 'You are not authorized to view this resource.'], 403);

        return SearchResource::collection($user->searches);
    }
}

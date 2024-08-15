<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $currentUser = Auth::user();
        // Find user except for authenticated one
        $users = Cache::remember('users', 120, function () use ($currentUser) {
            return User::when($currentUser, function ($query) use ($currentUser) {
                return $query->where('id', '!=', $currentUser->id);
            })->get();
        });

        return Inertia::render('User/Index', [
            'users' => UserResource::collection($users),
            'favorite_ids' => $currentUser != null ? $currentUser->favorites->pluck('id')->toArray() : [],
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
    public function show(string $id)
    {
        //
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

    /**
    * Add user to favorite list
    */
    public function favorite(User $user) {
        $currentUser = Auth::user();
        $message = "";
        $favorites = $currentUser->favorites->pluck('id')->toArray();
        if(Arr::first($favorites, fn (int $id) => $id === $user->id) === null) {
            User::find($currentUser->id)->favorites()->attach($user->id);
            $message = "User added to favorites";
        } else {
            User::find($currentUser->id)->favorites()->detach($user->id);
            $message = "User removed from favorites";
        }

        return redirect()->back()->with('message', $message);
    }
}

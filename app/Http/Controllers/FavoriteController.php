<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FavoriteController extends Controller
{

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'movie_id' => 'required|exists:movies,id',
            'user_id' => 'required|exists:users,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $movie = Movie::findOrFail($request->input('movie_id'));
        $user = User::findOrFail($request->input('user_id'));

        $user->movies()->attach($movie->id);

        return response()->json(['message' => 'Movie attached to user successfully'], 200);
    }

    public function destroy(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'movie_id' => 'required|exists:movies,id',
            'user_id' => 'required|exists:users,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $movie = Movie::findOrFail($request->input('movie_id'));
        $user = User::findOrFail($request->input('user_id'));

        $user->movies()->detach($movie->id);

        return response()->json(['message' => 'Movie detached from user successfully'], 200);
    }

    public function isFavorite(Request $request, Movie $movie)
    {
        $user = $request->user();
        
        // Check if the authenticated user has the movie with the given ID
        $isFavorite = $user->movies()->where('movie_id', $movie->id)->exists();

        return response()->json(['is_favorite' => $isFavorite], 200);
    }

}

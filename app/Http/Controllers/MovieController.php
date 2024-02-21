<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Resources\MovieResource;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $movies = Movie::paginate(10);

        return MovieResource::collection($movies);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'release_year' => 'required|integer|min:1900|max:' . date('Y'),
            'description' => 'required|string',
            'poster_url' => 'required|url',
            'genre' => 'required|array',
        ]);

        $movie = Movie::create([
            'title' => $request->input('title'),
            'release_year' => $request->input('release_year'),
            'description' => $request->input('description'),
            'poster_url' => $request->input('poster_url'),
            'genre' => json_encode($request->input('genre')),
        ]);

        return response()->json(['message' => 'Movie created successfully', 'data' => $movie], 201);
    }

    /**
     * Display the specified movie.
     *
     * @param  \App\Models\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function show(Movie $movie)
    {
        return response()->json($movie, Response::HTTP_OK);
    }

    /**
     * Update the specified movie in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Movie $movie)
    {
        $validatedData = $request->validate([
            'title' => 'string|max:255',
            'release_year' => 'integer|min:1900|max:' . date('Y'),
            'description' => 'string',
            'poster_url' => 'string|url',
            'genre' => 'array',
        ]);

        $movie->update($validatedData);

        return response()->json($movie, Response::HTTP_OK);
    }

    /**
     * Remove the specified movie from storage.
     *
     * @param  \App\Models\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function destroy(Movie $movie)
    {
        $movie->delete();

        return response()->json(['message' => 'Movie deleted successfully'], Response::HTTP_OK);
    }
}

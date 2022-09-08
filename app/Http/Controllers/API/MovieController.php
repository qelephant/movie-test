<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMovieRequest;
use App\Http\Resources\MovieResource;
use App\Models\Genre;
use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Movie::with('genres')->paginate(10));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMovieRequest $request)
    {
        $imageName = Str::random(32).".".$request->image->getClientOriginalExtension();
        $movie = Movie::create([
            'name' => $request->name,
            'status' => $request->status,
            'image' => $imageName
        ]);
        Storage::disk('public')->put($imageName, file_get_contents($request->image));

        $genre = Genre::findOrFail($request->genre_id);
        $movie->genres()->attach($genre);
        return new MovieResource($movie);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function show(Movie $movie)
    {
        $movie = $movie->load('genres');
        return response()->json($movie);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Movie $movie)
    {

        $movie->update($request->all());

        return response()->json($movie, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function destroy(Movie $movie)
    {
        if(Storage::disk('public')->exists($movie->image)){
            Storage::disk('public')->delete($movie->image);
        }
        $movie->delete();

        return response()->json(null, 204);
    }

    // Activate Movie status

    public function activateMovie($id)
    {
        $movie = Movie::findOrFail($id);
        if($movie->status == 'Inactive'){
        $movie->status = 'Active';
        $movie->save();
        }
        return response()->json($movie, 200);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Actor;
use App\Models\Movie;
use App\Models\Director;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class MovieAPIController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $movies = Movie::all();
        return $movies;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'duration' => 'required|integer',
            'release' => 'required|date',
            'director_id' => 'nullable|int'
        ]);

        $movie = new Movie();
        // dd($validated);
        $movie->name = $validated['name'];
        $movie->description = $validated['description'];
        $movie->duration = $validated['duration'];
        $movie->release = $validated['release'];
        
        if($validated['director_id']){
            $movie->director_id = $validated['director_id'];
        } else {
            $movie->director_id = Null;
        }
        
        // {
        //     "name": "Le bon film",
        //     "description": "Le bon film de la part de yessir",
        //     "duration": 112,
        //     "release": "2014-01-30",
        //     "director_id": 5
        // }

        $movie->save();
        return ["result" => "C'est good"];
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $movie = Movie::find($id);
        return $movie;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $movie = Movie::find($id);
        // $validated = $request->validate([
        //     'name' => 'required|string|max:255',
        //     'description' => 'required|string',
        //     'duration' => 'required|integer',
        //     'release' => 'required|date',
        //     'director_id' => 'nullable|int'
        // ]);
        $data = $request->all();
        
        foreach($data as $key => $value){
            // dump($key);
            if($movie->$key){
                $movie->$key = $value;
            }
        }
        $movie->save();

        return $movie;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $movie = Movie::find($id);
        $movie->delete();
    }

    public function actors($id)
    {
        $movie = Movie::find($id);
        $actors = $movie->actors;
        // $actors = Actor::where('movie_id', $id)->get();

        return $actors;
    }

    public function director($id)
    {
        $movie = Movie::find($id);
        $director = Director::find($movie->director_id);
        return $director;
    }

    public function actorInMovies(Request $request, $id)
    {
        $movie = Actor::find($id);

        $validated = $request->validate([
            'actor_id' => 'required|int'
        ]);
        // dd($movie);

        // $movie->setActors($validated['actor_id']);
        // $movie->save();

        // return ["result" => "C'est good", "movie" => $movie, "test" => $movie->actors];
        return ["result" => get_class_methods($movie)];
        // return ["result" => $movie->getRelations];

    }
    
}

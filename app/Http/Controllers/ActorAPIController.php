<?php

namespace App\Http\Controllers;

use App\Models\Actor;
use Illuminate\Http\Request;

class ActorAPIController extends Controller
{
        /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $actors = Actor::all();
        return $actors;
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
        ]);

        $actor = new Actor();
        // dd($validated);
        $actor->name = $validated['name'];

        // {
        //     "id": 1,
        //     "name": "Declan Anderson",
        //     "created_at": "2022-11-28T12:29:10.000000Z",
        //     "updated_at": "2022-11-28T12:29:10.000000Z"
        // }

        $actor->save();
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
        $actor = Actor::find($id);
        return $actor;
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
        $actor = Actor::find($id);
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
            if($actor->$key){
                $actor->$key = $value;
            }
        }
        $actor->save();

        return $actor;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $actor = Actor::find($id);
        $actor->delete();
    }

    public function movies($id)
    {
        $actor = Actor::find($id);
        $movies = $actor->movies;
        // $actors = Actor::where('movie_id', $id)->get();

        return $movies;
    }

}

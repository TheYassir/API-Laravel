<?php

namespace App\Http\Controllers;

use App\Models\Director;
use Illuminate\Http\Request;

class DirectorAPIController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $movies = Director::all();
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
        ]);

        $director = new Director();
        // dd($validated);
        $director->name = $validated['name'];

        // {
        //     "id": 1,
        //     "name": "Declan Anderson",
        //     "created_at": "2022-11-28T12:29:10.000000Z",
        //     "updated_at": "2022-11-28T12:29:10.000000Z"
        // }

        $director->save();
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
        $director = Director::find($id);
        return $director;
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
        $director = Director::find($id);
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
            if($director->$key){
                $director->$key = $value;
            }
        }
        $director->save();

        return $director;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $director = Director::find($id);
        $director->delete();
        return ["result" => "C'est supprime good"];
    }

    public function movies($id)
    {
        $director = Director::find($id);
        $movies = $director->movies;
        // $actors = Actor::where('movie_id', $id)->get();

        return $movies;
    }
    

}

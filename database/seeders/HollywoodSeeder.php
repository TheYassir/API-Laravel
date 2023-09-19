<?php

namespace Database\Seeders;

use App\Models\Actor;
use App\Models\Director;
use App\Models\Movie;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HollywoodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $directors = Director::factory()->count(30)->create();
        $actors = Actor::factory()->count(100)->create();

        Movie::factory()
               ->count(50)
               ->state(
                fn() => ['director_id' => $directors->random()]
               )
               ->create()
               ->each(
                fn ($movie) => $movie->actors()
                                     ->attach($actors->random(rand(5, 10)))
               );

        /*
        //save() permet de relier des modèles qui ont une relation
        // hasMany / belongsTo entre eux
        $movie = \App\Models\Movie::find(1);
        $director = \App\Models\Director::find(5);
        $director->movies()
                 ->save($movie);

        //pour belongsToMany, ce sera attach()
        $actor = \App\Models\Actor::find(10);

        $actor->movies()
              ->attach($movie);
        */
    }
}

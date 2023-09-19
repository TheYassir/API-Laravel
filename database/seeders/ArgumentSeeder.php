<?php

namespace Database\Seeders;

use App\Models\Argument;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ArgumentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //On va créer 8 arguments qu'on va insérer en DB
        Argument::factory(8)->create();
    }
}

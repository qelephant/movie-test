<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Genre::factory(10)->create();
        \App\Models\Genre::All()->each(function ($genre){
            $genre->movies()->saveMany(\App\Models\Movie::factory(random_int(3,8))->create());
        });
    }
}

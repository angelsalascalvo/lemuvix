<?php

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
        $this->call(UsersTableSeeder::class);
        $this->call(MoviesTableSeeder::class);
        $this->call(GenresTableSeeder::class);
        $this->call(GenreMovieTableSeeder::class);
        $this->call(PeopleTableSeeder::class);
        $this->call(ActorsMoviesTableSeeder::class);
        $this->call(DirectorsMoviesTableSeeder::class);
    }
}

<?php

use Illuminate\Database\Seeder;

class DirectorsMoviesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('actor_movie')->insert([
            'id_movie'=>1,
            'id_actor'=>3
        ]);

        DB::table('actor_movie')->insert([
            'id_movie'=>1,
            'id_actor'=>1
        ]);

        DB::table('actor_movie')->insert([
            'id_movie'=>2,
            'id_actor'=>1
        ]);

        DB::table('actor_movie')->insert([
            'id_movie'=>3,
            'id_actor'=>5
        ]);

        DB::table('actor_movie')->insert([
            'id_movie'=>4,
            'id_actor'=>4
        ]);

        DB::table('actor_movie')->insert([
            'id_movie'=>4,
            'id_actor'=>1
        ]);
    }
}

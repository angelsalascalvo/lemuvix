<?php

use Illuminate\Database\Seeder;

class ActorsMoviesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('actor_movie')->insert([
            'id_movie'=>2,
            'id_actor'=>4
        ]);

        DB::table('actor_movie')->insert([
            'id_movie'=>2,
            'id_actor'=>5
        ]);

        DB::table('actor_movie')->insert([
            'id_movie'=>2,
            'id_actor'=>6
        ]);

        DB::table('actor_movie')->insert([
            'id_movie'=>3,
            'id_actor'=>8
        ]);

        DB::table('actor_movie')->insert([
            'id_movie'=>3,
            'id_actor'=>9
        ]);

        DB::table('actor_movie')->insert([
            'id_movie'=>3,
            'id_actor'=>10
        ]);

        DB::table('actor_movie')->insert([
            'id_movie'=>3,
            'id_actor'=>18
        ]);

        DB::table('actor_movie')->insert([
            'id_movie'=>4,
            'id_actor'=>19
        ]);

        DB::table('actor_movie')->insert([
            'id_movie'=>4,
            'id_actor'=>12
        ]);

        DB::table('actor_movie')->insert([
            'id_movie'=>4,
            'id_actor'=>13
        ]);

        DB::table('actor_movie')->insert([
            'id_movie'=>5,
            'id_actor'=>15
        ]);

        DB::table('actor_movie')->insert([
            'id_movie'=>5,
            'id_actor'=>16
        ]);

        DB::table('actor_movie')->insert([
            'id_movie'=>5,
            'id_actor'=>17
        ]);

        //A continuacion los datos no son reales

        DB::table('actor_movie')->insert([
            'id_movie'=>8,
            'id_actor'=>4
        ]);

        DB::table('actor_movie')->insert([
            'id_movie'=>7,
            'id_actor'=>4
        ]);

        DB::table('actor_movie')->insert([
            'id_movie'=>7,
            'id_actor'=>6
        ]);

        DB::table('actor_movie')->insert([
            'id_movie'=>8,
            'id_actor'=>11
        ]);

        DB::table('actor_movie')->insert([
            'id_movie'=>8,
            'id_actor'=>3
        ]);

        DB::table('actor_movie')->insert([
            'id_movie'=>8,
            'id_actor'=>7
        ]);
    }
}

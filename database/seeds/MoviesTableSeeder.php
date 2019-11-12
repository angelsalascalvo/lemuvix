<?php

use Illuminate\Database\Seeder;

class MoviesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('movies')->truncate();
        DB::table('movies')->insert([
            'id'=>1,
            'title'=>'Monstruos S.A',
            'sinopsis' =>'Monsters Inc. es la mayor empresa de miedo del mundo, y James P. Sullivan es uno de sus mejores empleados. Asustar a los niños no es un trabajo fácil, ya que todos creen que los niños son tóxicos y no pueden tener contacto con ellos. Pero un día una niña se cuela sin querer en la empresa, provocando el caos.',
            'duration' => 88,
            'year' => 2001,
            'rating' => 8.0,
            'poster' => 'poster1.jpg',
            'created_at' => date('Y-m-d H:m:s'),
            'updated_at' => date('Y-m-d H:m:s')
        ]);
        DB::table('movies')->insert([
            'id'=>2,
            'title'=>'El desafío',
            'sinopsis' =>'Basada en las memorias escritas por Philippe Petit (Joseph Gordon-Levitt), un funambulista francés que, en 1974, guiado por su mentor Papa Rudy (Ben Kingsley), se propuso un reto nunca antes realizado: recorrer sobre un cable el espacio que separaba las Torres Gemelas de Nueva York.',
            'duration' => 116,
            'year' => 2015,
            'rating' => 7.0,
            'poster' => 'poster2.jpg',
            'created_at' => date('Y-m-d H:m:s'),
            'updated_at' => date('Y-m-d H:m:s')
        ]);
        DB::table('movies')->insert([
            'id'=>3,
            'title'=>'Steve Jobs',
            'sinopsis' =>'Biopic del mítico empresario y programador informático Steve Jobs (1955-2011), centrado en la época en la que lanzó los tres productos icónicos de Apple.',
            'duration' => 121,
            'year' => 2015,
            'rating' => 6.0,
            'poster' => 'poster3.jpg',
            'created_at' => date('Y-m-d H:m:s'),
            'updated_at' => date('Y-m-d H:m:s')
        ]);
        DB::table('movies')->insert([
            'id'=>4,
            'title'=>'Blade Runner 2049',
            'sinopsis' =>'Treinta años después de los eventos del primer film, un nuevo blade runner, K (Ryan Gosling) descubre un secreto profundamente oculto que podría acabar con el caos que impera en la sociedad. El descubrimiento de K le lleva a iniciar la búsqueda de Rick Deckard (Harrison Ford), un blade runner al que se le perdió la pista hace 30 años.',
            'duration' => 163,
            'year' => 2017,
            'rating' => 7.0,
            'poster' => 'poster4.jpg',
            'created_at' => date('Y-m-d H:m:s'),
            'updated_at' => date('Y-m-d H:m:s')
        ]);
        DB::table('movies')->insert([
            'id'=>5,
            'title'=>'Johnny English 3.0',
            'sinopsis' =>'Cuando un ciberataque revela la identidad de todos los agentes secretos en activo de Reino Unido, Johnny English se convierte en la única esperanza del servicio secreto. Para para encontrar al hacker, esto fuerza su regreso después de retirarse, pero como sus habilidades son bastante limitadas English tendrá que esforzarse para superar los desafíos tecnológicos de la era moderna.',
            'duration' => 88,
            'year' => 2018,
            'rating' => 5.0,
            'created_at' => date('Y-m-d H:m:s'),
            'updated_at' => date('Y-m-d H:m:s')
        ]);
    }
}

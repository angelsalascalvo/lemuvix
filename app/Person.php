<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    
    protected $fillable = [
        'name'
    ];

    /**
     * METODO PARA OBTENER LAS PELICULAS EN LAS QUE HA ACTUADO LA PERSONA
     */
    public function moviesActed(){
        return $this->belongsToMany('App\Movie', 'actor_movie', 'id_genre', 'id_movie'); 
    }

    /**
     * METODO PARA OBTENER LAS PELICULAS QUE HA DIRIGIDO LA PERSONA
     */
    public function moviesDirected(){
        return $this->belongsToMany('App\Movie', 'director_movie', 'id_genre', 'id_movie'); 
    }
}

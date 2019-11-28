<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    
    //Campos que pueden agragarse al objeto por asignacion masiva
    protected $fillable = [
        'title', 'sinopsis', 'duration', 'year', 'rating', 'filepath', 'filename', 'urlsync'
    ];

    /**
     * METODO PARA OBTENER LOS GENEROS ASOCIADOS A LA PELICULA
     */
    public function genres(){
        //Modelo para relacion | tabla intermedia | campo correspondiente a esta tabla | campo correspondiente con la tabla ajena
        return $this->belongsToMany('App\Genre', 'genre_movie', 'id_movie', 'id_genre'); 

        //El metodo belongsToMany puede utilizarse con un unico parametro indicando el modelo con el que relacionarse
        //siempre y cuando los nombres respeten la convencion de laravel
        // tabla => nombretsingular1_nombretsingular2 ordenado alfabeticamente
        // campos de relacion => nombretsingular_id
    }

    /**
     * METODO PARA OBTENER LOS ACTORES ASOCIADOS A LA PELICULA
     */
    public function actors(){
        return $this->belongsToMany('App\Person', 'actor_movie', 'id_movie', 'id_actor'); 
    }

    /**
     * METODO PARA OBTENER LOS DIRECTORIOS ASOCIADOS A LA PELICULA
     */
    public function directors(){
        return $this->belongsToMany('App\Person', 'director_movie', 'id_movie', 'id_director'); 
    }
}

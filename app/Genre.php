<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    //Campos que pueden agragarse al objeto por asignacion masiva
    protected $fillable = [
        'description'
    ];

    /**
     * METODO PARA OBTENER LAS PELICULAS RELACIONADAS CON UN DETERMINADO GENERO
     */
    public function movies(){
        //Modelo para relacion | tabla intermedia | campo correspondiente a esta tabla | campo correspondiente con la tabla ajena
        return $this->belongsToMany('App\Movie', 'genre_movie', 'id_genre', 'id_movie'); 
    }

}

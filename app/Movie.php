<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    //Campos que pueden agragarse al objeto por asignacion masiva
    protected $fillable = [
        'title', 'sinopsis', 'duration', 'year', 'rating'
    ];

    public function genres(){
        //Modelo para relacion | tabla intermedia | campo correspondiente a esta tabla | campo correspondiente con la tabla ajena
        return $this->belongsToMany('App\Genre', 'genre_movie', 'id_movie', 'id_genre'); 

        //El metodo belongsToMany puede utilizarse con un unico parametro indicando el modelo con el que relacionarse
        //siempre y cuando los nombres respeten la convencion de laravel
        // tabla => nombretsingular1_nombretsingular2 ordenado alfabeticamente
        // campos de relacion => nombretsingular_id
    }

}

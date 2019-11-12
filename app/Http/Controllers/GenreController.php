<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Genre;

class GenreController extends Controller
{
    /**
     *  METODO PARA MOSTRAR LA VISTA QUE MOSTRARÁ TODOS LOS GENEROS
     */
    public function index(){
        return view('genre/index', ['genres'=> Genre::all()]);
    }

    //------------------------------------------------------------------------------

    /**
     * METODO PARA MOSTRAR EL FORMULARIO DE CREAR GENERO
     */
    public function create(){
        return view('genre/form', ['action'=>'create']);
    }

    //------------------------------------------------------------------------------

    /**
     * METODO PARA ALMACENAR EL GENERO EN LA BASE DE DATOS
     */
    public function store(Request $result){
        $gen = new Genre($result->all());
        $gen->id = Genre::max('id')+1;

        if($result->hasFile('image')){
            //Crear un nombre para almacenar el fichero
            $name = "genre".$gen->id.".".$result->file('image')->getClientOriginalExtension();
            //Guardar el nombre en la base de datos
            $gen->image = $name;
            //Almacenar el archivo en el directorio
            $result->file('image')->move(public_path('img/genres/'), $name);
        }

        $gen->save();

        //Redirigir
        return redirect(route("genre.index"));
    }

   //------------------------------------------------------------------------------

    /**
     * METODO PARA MOSTRAR AL VISTA DE EDICION DE GENERO
     */
    public function edit($id){
        return view('genre/form', ['action'=>'edit']);
    }

    //------------------------------------------------------------------------------

    /**
     * METODO PARA REALIZAR EL PROPIO PROCESO DE ACTUALIZACION EN LA BASE DE DATOS DE LOS DATOS
     */
    public function update(Request $result)
    {
        $gen = Genres::find($result->id);
        $gen->fill($result->all()); //Fill rellena los campos del objeto pasados en un array

        //Comprobar si existe un archivo "Poster" adjunto
        if($result->hasFile('image')){
            //Crear un nombre para almacenar el fichero
            $name = "image".$gen->id.".".$result->file('poster')->getClientOriginalExtension();
            //Guardar el nombre en la base de datos
            $gen->poster = $name;
            //Almacenar el archivo en el directorio
            $result->file('image')->move(public_path('img/genres/'), $name);
        }

        $gen->save();

        //Redirigir
        return redirect(route("genre.index"));
    }

    //------------------------------------------------------------------------------

    /**
     * METODO PARA ELIMINAR UN GENERO DE LA BASE DE DATOS
     */
    public function destroy($id)
    {
        $gen = User::find($id);
        $gen->delete();

        //Redirigir
        return redirect(route("genre.index"));
    }
}

<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Movie;

class MovieController extends Controller
{
     /**
     * METODO PARA MOSTRAR LA PAGINA DE INICIO DE PELICULAS
     */
    public function index(){
        $all = Movie::all();
        return view('movie/index', ['movies'=>$all, 'type'=>'movie']);
    }

    //------------------------------------------------------------------------------

    /**
     * METODO PARA MOSTRAR EL FORMULARIO DE CREAR PELICULA
     */
    public function create(){
        return view('movie/form', ['action'=>'create', 'type'=>'movie']);
    }

    //------------------------------------------------------------------------------

    /**
     * METODO PARA REALIZAR LA ACCIÓN DE GUARDADO DE LOS DATOS DE UN NUEVO PELICULA
     */
    public function store(Request $result){
        $mov = new Movie($result->all());
        $mov->id = Movie::max('id')+1;
        $mov->save();

        //Redirigir
        return redirect(route("movie.index"));
    }

    //------------------------------------------------------------------------------

    /**
     * METODO PARA MOSTRAR EL FORMULARIO DE EDICION DE UNA PELICULA PASADA POR LA URL (ID)
     */
    public function edit(Movie $id){
        //$id vale directamente los valores del objeto con ese id, igual que find
        return view('movie/form', ['datos'=>$id, 'action'=>'edit', 'type'=>'movie']);
    }

    //------------------------------------------------------------------------------

    /**
     * METODO PARA REALIZAR LA ACCION DE ACTUALIZACION DE DATOS DE LA PELICULA EN LA BASE DE DATOS
     */
    public function update(Request $result){
        $mov = Movie::find($result->id);
        $mov->fill($result->all()); //Fill rellena los campos del objeto pasados en un array
        $mov->save();

        //Redirigir
        return redirect(route("movie.index"));
    }

    //------------------------------------------------------------------------------

    /**
     * METODO PARA ELIMINAR LOS DATOS DE LA PELICULA INDICADO POR LA URL (ID) DE LA BASE DE DATOS
     */
    public function destroy($id){
        $mov = Movie::find($id);
        $mov->delete();

        //Redirigir
        return redirect(route("movie.index"));
    }
}

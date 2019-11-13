<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Movie;
use App\Genre;

class MovieController extends Controller
{
     /**
     * METODO PARA MOSTRAR LA PAGINA DE INICIO DE PELICULAS
     */
    public function index(){
        $all = Movie::all();
        return view('movie/index', ['movies'=>$all, 'type'=>'movie', 'footer'=>'big']);
    }

    //------------------------------------------------------------------------------

    /**
     * METODO PARA MOSTRAR LA INFORMACION COMPLETA DE LA PELICUA
     */
    public function show(Movie $id){
        return view('movie/show', ['movie'=>$id, 'type'=>'movie']);
    }

    //------------------------------------------------------------------------------

    /**
     * METODO PARA MOSTRAR EL FORMULARIO DE CREAR PELICULA
     */
    public function create(){
        return view('movie/form', ['action'=>'create', 'type'=>'movie', 'genres'=>Genre::all()]);
    }

    //------------------------------------------------------------------------------

    /**
     * METODO PARA REALIZAR LA ACCIÓN DE GUARDADO DE LOS DATOS DE UN NUEVO PELICULA
     */
    public function store(Request $result){
        $mov = new Movie($result->all());
        $mov->id = Movie::max('id')+1;
        
        //Comprobar si existe un archivo "Poster" adjunto
        if($result->hasFile('poster')){
            //Crear un nombre para almacenar el fichero
            $name = "poster".$mov->id.".".$result->file('poster')->getClientOriginalExtension();
            //Guardar el nombre en la base de datos
            $mov->poster = $name;
            //Almacenar el archivo en el directorio
            $result->file('poster')->move(public_path('img/movies/'), $name);
        }

        //Almacenar relacion con generos
        $mov->genres()->attach($result->genres); //Attach crea una fila en la tabla intermedia por casa valor pasado en su array por parametro
        
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
        return view('movie/form', ['data'=>$id, 'action'=>'edit', 'type'=>'movie', 'genres'=>Genre::all()]);
    }

    //------------------------------------------------------------------------------

    /**
     * METODO PARA REALIZAR LA ACCION DE ACTUALIZACION DE DATOS DE LA PELICULA EN LA BASE DE DATOS
     */
    public function update(Request $result){
        $mov = Movie::find($result->id);
        $mov->fill($result->all()); //Fill rellena los campos del objeto pasados en un array

        //Comprobar si existe un archivo "Poster" adjunto
        if($result->hasFile('poster')){
            //Crear un nombre para almacenar el fichero
            $name = "poster".$mov->id.".".$result->file('poster')->getClientOriginalExtension();
            //Eliminar anterior poster
            if($mov->poster!=null){
                unlink(public_path('img/movies/'.$mov->poster));
            }
            //Guardar el nombre en la base de datos
            $mov->poster = $name;
            //Almacenar el archivo en el directorio
            $result->file('poster')->move(public_path('img/movies/'), $name);
        }

        //Actualizar relacion con generos
        $mov->genres()->detach($mov->genres); //Eliminar antiguas relaciones
        $mov->genres()->attach($result->genres); //Agregar nuevas relaciones seleccionadas

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
        //Eliminar cartel
        if($mov->poster!=null){
            unlink(public_path('img/movies/'.$mov->poster)); //Eliminar cartel
        }
        $mov->delete();
        
        //Redirigir
        return redirect(route("movie.index"));
    }
}

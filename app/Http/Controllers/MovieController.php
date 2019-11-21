<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Movie;
use App\Genre;
use App\Person;

class MovieController extends Controller
{

    public function __construct() {
        // Solo usuarios logueados podrán acceder a este controlador:
        $this->middleware("auth")->except("show","index");
    }

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
        return view('movie/show', ['movie'=>$id]);
    }

    //------------------------------------------------------------------------------

    /**
     * METODO PARA MOSTRAR EL FORMULARIO DE CREAR PELICULA
     */
    public function create(){
        return view('movie/form', ['action'=>'create', 'genres'=>Genre::all(), 'people'=>Person::all()]);
    }

    //------------------------------------------------------------------------------

    /**
     * METODO PARA REALIZAR LA ACCIÓN DE GUARDADO DE LOS DATOS DE UN NUEVO PELICULA
     */
    public function store(Request $result){
        //Validacion de datos
        $result->validate([
            'title' => 'required',
            'sinopsis' => 'required',
            'duration' => 'required|integer|min:1',
            'year'=>'required|digits:4|integer',
            'rating'=>'required|integer|between:1,5'
        ]); 

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
        
        //Almacenar relaciones
        $mov->genres()->attach($result->genres); //Attach crea una fila en la tabla intermedia por casa valor pasado en su array por parametro
        $mov->actors()->attach($result->actors);
        $mov->directors()->attach($result->directors);

        //Guardar pelicula
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
        return view('movie/form', ['data'=>$id, 'action'=>'edit', 'genres'=>Genre::all(), 'people'=>Person::all()]);
    }

    //------------------------------------------------------------------------------

    /**
     * METODO PARA REALIZAR LA ACCION DE ACTUALIZACION DE DATOS DE LA PELICULA EN LA BASE DE DATOS
     */
    public function update(Request $result, $id){
        //Validacion de datos
        $result->validate([
            'title' => 'required',
            'sinopsis' => 'required',
            'duration' => 'required|integer|min:1',
            'year'=>'required|digits:4|integer',
            'rating'=>'required|integer|between:1,5'
            ]);

        $mov = Movie::find($id);
        $mov->fill($result->all()); //Fill rellena los campos del objeto pasados en un array

        //Comprobar si existe un archivo "Poster" adjunto
        if($result->hasFile('poster')){
            //Crear un nombre para almacenar el fichero
            $name = "poster".$mov->id.".".$result->file('poster')->getClientOriginalExtension();
            //Eliminar anterior poster
            if($mov->poster!=null && file_exists(public_path('img/movies/'.$mov->poster))){
                unlink(public_path('img/movies/'.$mov->poster));
            }
            //Guardar el nombre en la base de datos
            $mov->poster = $name;
            //Almacenar el archivo en el directorio
            $result->file('poster')->move(public_path('img/movies/'), $name);
        }

        //Actualizar relacion con generos
        $mov->genres()->sync($result->genres); //Sync es como una eliminacion detach y agregacion attacch
        $mov->directors()->sync($result->directors);
        $mov->actors()->sync($result->actors);

        //Guardar pelicula
        $mov->save();

        //Redirigir
        return redirect(route("movie.index"));
    }

    //------------------------------------------------------------------------------

    /**
     * METODO PARA ELIMINAR LOS DATOS DE LA PELICULA INDICADO POR LA URL (ID) DE LA BASE DE DATOS
     */
    public function destroy(Request $result, $id){
        $mov = Movie::find($id);
        //Eliminar relaciones con generos
        $mov->genres()->detach();
        $mov->actors()->detach();
        $mov->directors()->detach();

        //Eliminar cartel
        if($mov->poster!=null && file_exists(public_path('img/movies/'.$mov->poster))){
            unlink(public_path('img/movies/'.$mov->poster)); //Eliminar cartel
        }
        //Eliminar pelicula
        $mov->delete();

        //Comprobar que se ha eliminado
        if(Movie::find($id)==null){
            //Redirigir en funcion de si es una peticion Ajax o no
            if($result->ajax()){
                return response()->json([
                    'status'=> true,
                    'id'=>$id
                ]);
            }
            return redirect(route("movie.index"));
        }else{
            $error='No se ha podido eliminar, error desconocido';
            if($result->ajax()){
                //Enviar error si no se ha podido eliminar
                return response()->json([
                    'status' => false,
                    'error' => $error
                ]);
            }
            return redirect(route("movie.index"))->with('error', $error);;
        }      
    }

    //------------------------------------------------------------------------------

    /**
     * METODO PARA MOSTRAR LAS PELICULAS ASOCIADAS A UN GENERO DETERMINADO
     */
    public function showByGenre(Genre $genre){
        $movies= Array();
        //Obtener las peliculas que corresponden con el genero pasado por parametro
        foreach(Movie::all() as $mov){
            foreach($mov->genres as $gen){
                if($genre->id == $gen->id){
                    array_push($movies, $mov);
                }
            }
        }
    
        return view('movie/index', ['movies'=>$movies, 'type'=>'movie', 'footer'=>'big', 'genre'=>$genre]);
    }
}

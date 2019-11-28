<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Genre;

class GenreController extends Controller{
    
    public function __construct() {
        // Solo usuarios logueados podrán acceder a este controlador:
        $this->middleware("auth")->except("index");
    }

    /**
     *  METODO PARA MOSTRAR LA VISTA QUE MOSTRARÁ TODOS LOS GENEROS
     */
    public function index(){
        return view('genre/index', ['genres'=> Genre::all(), 'showBar'=>'true', 'footer'=>'big']);
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
        //Validacion de datos
        $result->validate([
            'description' => 'required|min:1|max:25'
        ]); 

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
        $gen = Genre::find($id);
        return view('genre/form', ['action'=>'edit', 'data'=>$gen]);
    }

    //------------------------------------------------------------------------------

    /**
     * METODO PARA REALIZAR EL PROPIO PROCESO DE ACTUALIZACION EN LA BASE DE DATOS DE LOS DATOS
     */
    public function update(Request $result, $id){
        //Validacion de datos
        $result->validate([
            'description' => 'required|min:1|max:25'
        ]); 
        
        $gen = Genre::find($id); //El nombre del id en este caso no es id ya que en el archivo de rutas hemos utilizado resource con el nombre genre
        $gen->fill($result->all());

        if($result->hasFile('image')){
            //Crear un nombre para almacenar el fichero
            $name = "image".$gen->id.".".$result->file('image')->getClientOriginalExtension();
            //Eliminar anterior imagen
            if($gen->image!=null && file_exists(public_path('img/genres/'.$gen->image))){
                unlink(public_path('img/genres/'.$gen->image));
            }
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
     * METODO PARA ELIMINAR UN GENERO DE LA BASE DE DATOS
     */
    public function destroy(Request $result, $id)
    {
        $gen = Genre::find($id);

        //Eliminar genero si no tiene peliculas asociadas
        if($gen->movies->count()==0){
            //Eliminar imagen
            if($gen->image!=null && file_exists(public_path('img/genres/'.$gen->image))){
                unlink(public_path('img/genres/'.$gen->image));
            }
            $gen->delete();
        }

        //Unicamente se elimna a traves de ajax
        if($result->ajax()){
            //Comprobar si se ha eliminado
            if(Genre::find($id)==null){
                return response()->json([
                   'status'=> true,
                    'id'=>$id
                ]);
            }

            //Enviar mensaje de error personalizado
            if($gen->movies->count()!=0){
                return response()->json([
                    'status' => false,
                    'error' => 'Imposible eliminar. El genero tiene '.$gen->movies->count().' peliculas asociadas.'
                ]);
            }else{
                return response()->json([
                    'status' => false,
                    'error' => 'No se ha podido eliminar. Error desconocido'
                ]);
            }
        }        
    }
}

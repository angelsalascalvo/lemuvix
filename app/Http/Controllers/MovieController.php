<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Movie;
use App\Genre;
use App\Person;
use Image;
include(public_path('scripts/simple_html_dom.php'));

class MovieController extends Controller
{
    public function __construct() {
        // Solo usuarios logueados podrán acceder a este controlador:
        $this->middleware("auth")->except("show","index","showByGenre");
    }

     /**
     * METODO PARA MOSTRAR LA PAGINA DE INICIO DE PELICULAS
     */
    public function index(){
        $all = Movie::all();
        return view('movie/index', ['movies'=>$all, 'showBar'=>'true', 'footer'=>'big']);
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
            'rating'=>'required|integer|between:1,10',
            'filename'=> 'required',
            'filepath' => 'required'
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
            'rating'=>'required|integer|between:1,10',
            'filename'=> 'required',
            'filepath' => 'required'
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
        //$mov->delete();

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
            return redirect(route("movie.index"))->with('error', $error);
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
    
        return view('movie/index', ['movies'=>$movies, 'showBar'=>'true', 'footer'=>'big', 'genre'=>$genre]);
    }

    //------------------------------------------------------------------------------

    /**
     * METODO PARA CREAR AUTOMATICAMENTE UNA PELICULA PARA LOS DIFERENTES ARCHIVOS DE VIDEO
     */
    public function scan(){
        $listFiles = array();
        $numMaxIndex = count(Movie::All());
        $this->getDirContents(public_path('/movies/'), $listFiles);
        $numScanned=0;

        //Recorrer todos los archivos obtenidos
        foreach ($listFiles as $key => $value) {
            $new = true;

            //Comprobar si el archivo de video tiene creada la pelicula
            foreach (Movie::All() as $keySaved => $valueSaved) {
                if(basename($value) == $valueSaved->filename){
                    $new=false;
                }
            }

            //Crear pelicula para el archivo de video si no tiene una ya creada
            if($new){

                //Obtener la ruta del fichero de video
                $path = "";
                $append = false;
                $array = explode("\\", $value);
        
                foreach ( $array as $valueDirec) {
                    if($append && $valueDirec!=basename($value)){
                        $path.= $valueDirec."/";
                    }
                    if($valueDirec=="public"){
                        $append=true;
                    }
                }

                //Llamada al metodo para guardar la pelicula escaneada
                $this->saveFilmScaned( explode(".", basename($value))[0], basename($value), $path);
                $numScanned++;
                
            }
        }
        
        //Redirigir
        if($numScanned == 0){
            $txt = "No hay peliculas nuevas para sincronizar";
        }else{
            $txt = "Se han sincronizado ".$numScanned." peliculas.";
        }
        return redirect(route("movie.index"))->with('error', $txt);
    }

    //----------------------------------------------------------------------------
    
    /**
     * METODO PARA CREAR UNA PELICULA ESCANEADA CON INFORMACION BÁSICA
     */
    function saveFilmScaned($title, $filename, $filepath){

        $mov = new Movie();
        $mov->id = Movie::max('id')+1;
        $mov->title = $title;
        $mov->sinopsis = "Sin sinopsis";
        $mov->year = 2000;
        $mov->rating = 0;
        $mov->duration = 100;
        $mov->filename = $filename;
        $mov->filepath = $filepath;
        //Almacenar pelicula
        $mov->save();
    }

    //------------------------------------------------------------------------------

    /**
     * METODO PARA ESCANEAR RECURSIVAMENTE TODOS LOS DIRECTORIOS Y SUBDIRECTORIOS DE LA RUTA DE LOS ARCHIVOS DE VIDEO
     */
    function  getDirContents($dir, &$results = array()){
        $files = scandir($dir);
    
        //Recorremos cada uno de los elementos localizados en el directorio
        foreach($files as $key => $value){
            $path = realpath($dir."/".$value);

            //Comprobar si es un fichero u otro directorio para actuar en funcion de esto
            if(is_file($path)) {
                $results[] = $path;
            //Evitar llamar al encontrarse con el nodo que referencia a si mismo o a su padre
            } else if($value != "." && $value != "..") {
                MovieController::getDirContents($path, $results);
            }
        }

        //Devolver todos los archivos encontrados
        return $results;
    }   

    //---------------------------------------------------------------------------------

    public function sincronization(){
        //Utilizaremos los metodos del script "simple_html_dom.php" para hacer scraping y obtener la informacion de filmAffinity

        //Busqueda en google para obtener el enlace
        $key = "steve jobs";
        //Busqueda avanzada para buscar solo en el dominio de filmaffinity
        $url = "https://www.google.es/search?q=".str_replace(" ","+",$key)."+sitio%3Afilmaffinity.com"; 
        $content = file_get_html($url);
        //Obtener el id del primer resultado de google correspondiente dentro de filmaffinity
        $idFilmAffinity = $content->find("div[class='BNeawe UPmit AP7Wnd']", 0)->plaintext;
        $idFilmAffinity = explode(" &#8250; ", $idFilmAffinity)[1];
        //Crear Url de filmaffinity
        $filmUrl = 'https://www.filmaffinity.com/es/'.$idFilmAffinity.".html";
        
        
        //Obtener los propios datos de la pelicula
        $content = file_get_html($filmUrl);
        $titleRead = trim($content->find("dl[class='movie-info'] dd",0)->plaintext);
        $ratingRead = trim($content->find("div[itemprop='ratingValue']",0)->plaintext);
        $ratingRead = explode(",", $ratingRead)[0];
        $yaerRead = trim($content->find("dd[itemprop='datePublished']",0)->plaintext);
        $durationRead = trim($content->find("dd[itemprop='duration']",0)->plaintext);
        $sinopsisRead = trim(str_replace("(FILMAFFINITY)", "", $content->find("dd[itemprop='description']",0)->plaintext));
        $urlCoverRead = $content->find("a[class='lightbox']",0)->href;
        
        //Descargar imagen estableciendo su nombre correspondiente
        Image::make($urlCoverRead)->save(public_path('img/saveAsImageName.jpg'));

        //Actualizar pelicula

        echo $titleRead."  |  ".$yaerRead."  |  ".$ratingRead."  |  ".$durationRead."  |  ".$sinopsisRead."  |  ".$urlCoverRead;
        

    }
    
}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Person;

class PersonController extends Controller
{
     /**
     *  METODO PARA MOSTRAR LA VISTA QUE MOSTRARÁ TODOS LAS PERSONAS
     */
    public function index(){
        return view('person/index', ['people'=> Person::all(), 'footer'=>'big']);
    }

    //------------------------------------------------------------------------------

    /**
     * METODO PARA MOSTRAR LA VISTA CORRESPONDIENTE CON LA INFORMACION COMPLETA DE UNA PERSONA
     */
    public function show(Person $person){
        return view('person/show', ['person'=>$person]);
    }

    //------------------------------------------------------------------------------

    /**
     * METODO PARA MOSTRAR EL FORMULARIO DE CREAR PERSONA
     */
    public function create(){
        return view('person/form', ['action'=>'create']);
    }

    //------------------------------------------------------------------------------

    /**
     * METODO PARA ALMACENAR LA PERSONA EN LA BASE DE DATOS
     */
    public function store(Request $result){
        $per = new Person($result->all());
        $per->id = Person::max('id')+1;

        if($result->hasFile('photo')){
            //Crear un nombre para almacenar el fichero
            $name = "person".$per->id.".".$result->file('photo')->getClientOriginalExtension();
            //Guardar el nombre en la base de datos
            $per->photo = $name;
            //Almacenar el archivo en el directorio
            $result->file('photo')->move(public_path('img/people/'), $name);
        }

        $per->save();

        //Redirigir
        return redirect(route("person.index"));
    }

   //------------------------------------------------------------------------------

    /**
     * METODO PARA MOSTRAR AL VISTA DE EDICION DE PERSONAS
     */
    public function edit (Person $person){
        return view('person/form', ['action'=>'edit', 'data'=>$person]);
    }

    //------------------------------------------------------------------------------

    /**
     * METODO PARA REALIZAR EL PROPIO PROCESO DE ACTUALIZACION EN LA BASE DE DATOS DE LOS DATOS
     */
    public function update(Request $result, $id){

        $per = Person::find($id);
        $per->fill($result->all());

        if($result->hasFile('photo')){
            //Crear un nombre para almacenar el fichero
            $name = "photo".$per->id.".".$result->file('photo')->getClientOriginalExtension();
            //Eliminar anterior imaper
            if($per->photo!=null && file_exists(public_path('img/people/'.$per->photo))){
                unlink(public_path('img/people/'.$per->photo));
            }
            //Guardar el nombre en la base de datos
            $per->photo = $name;
            //Almacenar el archivo en el directorio
            $result->file('photo')->move(public_path('img/person/'), $name);
        }

        $per->save();

        //Redirigir
        return redirect(route("person.index"));
    }

    //------------------------------------------------------------------------------

    /**
     * METODO PARA ELIMINAR UNA PERSONA DE LA BASE DE DATOS
     */
    public function destroy($id)
    {
        $per = Person::find($id);

        //Eliminar persona si no tiene peliculas asociadas
        if($per->moviesActed->count()==0 && $per->moviesDirected->count()==0){
            //Eliminar imaper
            if($per->photo!=null && file_exists(public_path('img/people/'.$per->photo)) ){
                unlink(public_path('img/people/'.$per->photo));
            }
            $per->delete();
        }

        //Redirigir
        return redirect(route("person.index"));
    }
}

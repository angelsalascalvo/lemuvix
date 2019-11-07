<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{

    /**
     * METODO PARA MOSTRAR LA PAGINA DE INICIO DE USUARIOS
     */
    public function index(){
        $todo = User::all();
        return view('user/index', ['usuarios'=>$todo]);
    }

    //------------------------------------------------------------------------------

    /**
     * METODO PARA MOSTRAR EL FORMULARIO DE CREAR USUARIO
     */
    public function create(){
        return view('user/form', ['action'=>'create']);
    }

    //------------------------------------------------------------------------------

    /**
     * METODO PARA REALIZAR LA ACCIÓN DE GUARDADO DE LOS DATOS DE UN NUEVO USUARIO
     */
    public function store(Request $result){
        $usu = new User($result->all());
        $usu->id = User::max('id')+1;
        //Comprobar si se ha seleccionado admin o no
        if($result->admin == "0"){
            $usu->admin=0;
        }else{
            $usu->admin=1;
        }

        $usu->save();

        //Redirigir
        return redirect(route("user.index"));
    }

    //------------------------------------------------------------------------------

    /**
     * METODO PARA MOSTRAR EL FORMULARIO DE EDICION DE UN USUARIO PASADO POR LA URL (ID)
     */
    public function edit($id){
        $datos = User::find($id);
        return view('user/form', ['datos'=>$datos, 'action'=>'edit']);
    }

    //------------------------------------------------------------------------------

    /**
     * METODO PARA REALIZAR LA ACCION DE ACTUALIZACION DE DATOS DEL USUARIO EN LA BASE DE DATOS
     */
    public function update(Request $result){
        $usu = User::find($result->id);
        $usu->fill($result->all()); //Fill rellena los campos del objeto pasados en un array
        
        //Comprobar si se ha seleccionado admin o no
        if($result->admin == "0"){
            $usu->admin=0;
        }else{
            $usu->admin=1;
        }
        $usu->save();

        //Redirigir
        return redirect(route("user.index"));
    }

    //------------------------------------------------------------------------------

    /**
     * METODO PARA ELIMINAR LOS DATOS DEL USUARIO INDICADO POR LA URL (ID) DE LA BASE DE DATOS
     */
    public function destroy($id){
        $usu = User::find($id);
        $usu->delete();

        //Redirigir
        return redirect(route("user.index"));
    }
}

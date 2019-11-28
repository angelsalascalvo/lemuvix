<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\User;

class UserController extends Controller{

    public function __construct() {
        // Solo usuarios logueados podrán acceder a este controlador:
        $this->middleware("auth");
    }

    /**
     * METODO PARA MOSTRAR LA PAGINA DE INICIO DE USUARIOS
     */
    public function index(){
        $todo = User::all();
        return view('user/index', ['users'=>$todo]);
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
        //Validacion de datos
        $result->validate([
            'nick' => 'required',
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password'=>'required'
        ]); 

        $usu = new User($result->all());
        $usu->id = User::max('id')+1;
        $usu->password = Hash::make($result->password);
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
        return view('user/form', ['data'=>$datos, 'action'=>'edit']);
    }

    //------------------------------------------------------------------------------

    /**
     * METODO PARA REALIZAR LA ACCION DE ACTUALIZACION DE DATOS DEL USUARIO EN LA BASE DE DATOS
     */
    public function update(Request $result, $id){
         //Validacion de datos
         $result->validate([
            'nick' => 'required',
            'name' => 'required',
            //Validacion para comprobar si el correo esta duplicado en una tupla diferente a la del propio usuario
            'email' => 'required|email|unique:users,email,'.$id,
            'password'=>'required'
        ]); 

        $usu = User::find($id);
        $usu->fill($result->all()); //Fill rellena los campos del objeto pasados en un array
        $usu->password = Hash::make($result->password);
        //Comprobar si se ha seleccionado admin o no
        if($result->admin == "0"){
            $usu->admin=0;
        }else{
            $usu->admin=1;
        }

        //Guardar datos
        $usu->save();

        //Redirigir
        return redirect(route("user.index"));
    }

    //------------------------------------------------------------------------------

    /**
     * METODO PARA ELIMINAR LOS DATOS DEL USUARIO INDICADO POR LA URL (ID) DE LA BASE DE DATOS
     */
    public function destroy(Request $result, $id){
        $usu = User::find($id);
        $usu->delete();

        //Comprobar que se ha eliminado
        if(User::find($id)==null){
            //Redirigir en funcion de si es una peticion Ajax o no
            if($result->ajax()){
                return response()->json([
                    'status'=> true,
                    'id'=>$id
                ]);

                return redirect(route("user.index"));
            }
        }else{
            $error='No se ha podido eliminar, error desconocido';
            if($result->ajax()){
                //Enviar error si no se ha podido eliminar
                return response()->json([
                    'status' => false,
                    'error' => $error
                ]);
            }
            return redirect(route("user.index"))->with('error', $error);;
        }      
    }
}

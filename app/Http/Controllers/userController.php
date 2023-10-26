<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Http\Request;

class userController extends Controller
{
    public function login(Request $request){
        $validacion = validator::make($request->all(),[
            'email'=>'required|email',
            'password'=>'required'
        ]);
        if ($validacion->fails()) {
            return response()->json([
                'mje' => "Verificar los datos ingresados",
                'status' =>0,
                'data' => ['error' => 'Error en el ingreso de datos']
            ]);
        }
        $modelo = new User();
        $response = $modelo->init_session($request);
        if ($response != ""){
            $data = $response;
            $mje = 'Login correcto';
            $status = 1;
        } else {
            $data = "";
            $mje = 'Login incorrecto verificar usuario y contraseña';
            $status = 0;
        }
        return response()->json([
            'access_token'=>$data,
            'mje'=>$mje,
            'status'=>$status
        ]);
    }
    public function logout(){
        $model = new User();
        $model->close_session();
        return response()->json(['mje'=>'fin de secion']);

    }
    public function store_login(Request $request){
        $validar = validator::make($request->all(),[
            'name'=>'required',
            'email'=>"required|email",
            'password'=>'required|confirmed',
        ]);
        if ($validar->fails()){
            return response()->json([
                'status' => 0,
                'data' =>['error'=>'Error de validacion verifique sus datos']
            ]);
        }
        $data = [];
        $mje="";
        $model = new User();
        $user = $model::where('email',$request->email)->get();
        if (!isset($user[0]->id)){
            $data = $model->store($request);
            if(!isset($data->id)){
                $status = 0;
            }else{
                $status = 1;
            }
        }else{
            $status = 0;
            $data = ['error'=>'El usuario ya existe'];
        }
        return   response()->json([
            'status' => $status,
            'data' => $data
        ]);

    }
    public function get_view_repassword(){
        return view('userPassword');
    }
    public function store_repassword(Request $request){
        //validar
        $model = new User();
        $validar = $model->validar_repassword($request);
        if ($validar['status'] == 0){
            return response()->json($validar);
        }
        //cambiar password
        $respuesta = $model->store_repassword($request);
        //retornar respuesta
       return response()->json($respuesta);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\silos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class silosController extends Controller
{
    public $model;
    public function __construct()
    {
        $this->model = new silos();
    }
    public function ingresar(Request $request){
        $validacion = Validator::make($request->all(),[
            ''
        ]);
        if ($validacion->fails()){
            return response()->json([
                'status' => 0,
                'mje' => $validacion->errors()
            ]);
        }
        //registrar
        $response = $this->model;
        if ($response == 1) {
            $status = 1;
            $mje = "OK";
        }else{
            $status = 0;
            $mje = "Error al intentar registar";
        }
    }
    public function listar(Request $request){

    }

    public function vista(){

    }
}

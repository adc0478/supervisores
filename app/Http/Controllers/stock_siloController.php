<?php

namespace App\Http\Controllers;

use App\Models\stock_silos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class stock_siloController extends Controller
{
    public $modelo;
    public function __construct()
    {
        $this->modelo = new stock_silos();
    }
    public function validar (Request $request){
        if ($request->idstock_silo != "") {
           $valor = "required|integer";
        }else {
           $valor = "";
        }
        $salida = Validator::make($request->all(),[
            'idstock_silo' => $valor,
            'silo_idsilo' => 'required|integer',
            'producto_idproducto' => 'required|integer'
        ]);
        return $salida;
    }
    public function ingresar(Request $request){
        $validacion = $this->validar($request);
        if ($validacion->fails()) {
            return response()->json([
                'mje' => $validacion->errors(),
                'status' => 0,
                'data' => []
            ]);
        }
        $salida = $this->modelo->store($request);
        if ($salida == 0) {
            $mje = 'Error de registro';
            $status = 0;
            $data = [];
        }else {
            $mje = 'Operacion exitosa';
            $status = 1;
            $data = $salida;
        }
        return response()->json([
            'mje' =>$mje,
            'status' => $status,
            'data' => $data
        ]);
    }
    public function eliminar(Request $request){
        $validacion = validator::make($request->all(),[
            'idstock_silo' => "required|integer"
        ]);
        if ($validacion->failed()) {
            return response()->json([
                'mje' => $validacion->errors(),
                'status' => 0,
                'data' =>[]
            ]);
        }
        $salida = $this->modelo->delete_key($request->idstock_silo);
        if ($salida == 1) {
            $mje = "Operacion exitosa";
            $status = 1;
            $data = [];
        }else {
            $mje = "Fallo la eliminacion del registro";
            $status = 0;
            $data = [];
        }
         return response()->json([
                'mje' => $mje,
                'status' => $status,
                'data' =>$data
            ]);
    }

}

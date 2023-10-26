<?php

namespace App\Http\Controllers;

use App\Models\lavados;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class lavadoController extends Controller
{
    public $modelo;

    public function __construct()
    {
        $this->modelo = new lavados();
    }

    public function validar (Request $request){
        if ($request->idlavado != ""){
            $edit = "required|integer";
        }else{
            $edit = "";
        }
        $salida = Validator::make($request->all(),[
            'idlavado' => $edit,
            'tipo' => "required",
            'hora' => "required",
            'idregistro' =>"required|integer",
            'idequipo' => "required|integer",
            'idtanque' => "required|integer"
        ]);
        return $salida;
    }
    public function ingresar(Request $request){
        $validar = $this->validar($request);
        if ($validar->fails()) {
            return response()->json([
                'status' => 0,
                'mje' => $validar->errors(),
                'data' => []
            ]);
        }
        $salida = $this->modelo->store($request);
        if (isset($salida->idlavado)) {
            $mje = "Operacion completa";
            $status = 1;
            $data = $salida;
        }else{
            $mje = "error al insertar el registro";
            $status = 0;
            $data = [];
        }
        return response()->json([
                'status' => $status,
                'mje' => $mje,
                'data' => $salida
        ]);
    }
    public function eliminar(Request $request){
        if ($request->idlavado == ""){
            return response()->json([
                'mje' => "No proporciona un registro a borrar",
                'status' => 0,
                'data' => []
            ]);
        }
        $salida = $this->modelo->delete_id($request->idlavado);
        if ($salida == 1){
            $mje = "Registro eliminado";
            $status = 1;
            $data = [];
        }else{
            $mje = "El registro no pudo ser eliminado";
            $status = 0;
            $data = [];
        }
        return response()->json([
                'status' => $status,
                'mje' => $mje,
                'data' => $data
        ]);
    }
}

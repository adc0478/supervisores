<?php

namespace App\Http\Controllers;

use App\Models\obs_maquinas;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class obsMaquinaController extends Controller
{
    public $model;
    public function __construct()
    {
        $this->model = new obs_maquinas();
    }
    public function validar (Request $request){
        $validacion = Validator::make($request->all(),[
            'detalle_maquina' => 'required',
            'peroxido' => 'required|decimal:2',
            'maquina_idmaquina' => 'required|integer',
            'registro_idregistro' => 'required|integer'
        ]);
        return $validacion;
    }
    public function ingresar(Request $request){
        $validacion = $this->validar($request);
        if ($validacion->fails()) {
            return response()->json([
                'mje' => $validacion->errors(),
                'data' =>[],
                'status' => 0
            ]);
        }
        //consultar con el modelo
        $salida = $this->model->store($request);
        if ($salida == true) {
            $data = [];
            $mje = "Lo operacion ha sido exitosa";
            $status = 1;
        }else{
            $data = [];
            $mje = "Error al modificar la BD";
            $status = 0;
        };
         return response()->json([
             'mje' => $mje,
             'data' =>$data,
             'status' => $status
            ]);
    }
    public function eliminar(Request $request){
        if ($request->idobs_maquina == "") {
            $status = 0;
            $mje = "Debe proporcionar un registro para eliminar";
            $data = [];
        }else{
            $salida = $this->model->delete_reg($request->idobs_maquina);
            if ($salida == 1){
                $status = 1;
                $mje = "Borrado exitoso";
                $data = [];
            }else{
                $status = 0;
                $mje = "Error al borrar";
                $data = [];
            }
        }
        return response()->json([
            'status' => $status,
            'mje' => $mje,
            'data' => $data
        ]);
    }
    public function buscar(Request $request){
       $dato = $this->model->get_by_id($request->idobs_maquina);
        return response()->json([
            'data' => $dato,
            'status' => 1,
            'mje' => "Respuesta de la consulta"
        ]);
    }
}

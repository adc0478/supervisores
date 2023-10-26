<?php

namespace App\Http\Controllers;

use App\Models\registros;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class registroController extends Controller
{
    public function validacion (Request $request){
        if ($request->fecha_fin != "") {
            $referencia = "date|after_or_equal:fecha";
        }else {
            $referencia = "";
        }
//falta validar
        $validar = Validator::make($request->all(),[
            'fecha'=>'required|date',
            'turno'=>'required',
            'fecha_fin' => $referencia
        ]);
        return $validar;
    }
    public function insert(Request $camp){
        $data = "";
        $model = new registros();
        $validar = $this->validacion($camp);
        if ($validar->fails()) {
            return response()->json([
                'mje' => $validar->errors(),
                'status' => 0,
                'data' => $data
            ]);
        }
        $respuesta = $model->exist_reg_open();
        if ($respuesta) {
            $status = 0;
            $mje = "Usted tiene un registro abierto";
        }else{
            $data = $model->store($camp);
            $status = 1;
            $mje = "Operacion realizada";
        }

        return response()->json([
            'data'=>$data,
            'mje'=>$mje,
            'status' => $status
        ]);

    }
    public function edit_reg(Request $request){
        if ($request->idregistro == "") {
            return response()->json([
                'mje' => "No proporciona ID",
                'status' => 0
            ]);
        }
        $validar = $this->validacion($request);
        if ($validar->fails()) {
            return response()->json([
                'mje' => $validar->errors(),
                'status' => 0,
            ]);

        }
        $model = new registros();
        $data = $model->modify($request);
        if (isset($data->idregistro)){
            $status = 1;
            $mje = "registro modificado";
        }else{
            $status = 0;
            $mje = "No se pudo modificar el registro";
        }
        return response()->json([
            'mje'=>$mje,
            'data'=>$data,
            'status'=> $status
        ]);

    }
    public function delete_reg(Request $request_id){
        $model = new registros();
//falta validar
        $validar = Validator::make($request_id->all(),[
            'idregistro'=>'required|integer'
        ]);
        if ($validar->fails()) {
            return response()->json([
                'mje'=>$validar->errors(),
                'status' => 0,
                'data' => ""
            ]);
        }
        $data = $model->delete_reg($request_id);
        return response()->json([
            'data'=>$data,
            'mje'=>'Operacion realizada'
        ]);
    }
    public function search_pending_byUser(){
        $data = [];
        $model = new registros();
        $data = $model->search_pending();
        return response()->json($data);
    }
    public function search_by_date(Request $request){
  $validar = Validator::make($request->all(),[
            'desde' =>"required|date",
            'hasta' => "required|date|after_or_equal:desde"
        ]);
        if ($validar->fails()){
            return response()->json([
                'data' => [],
                'mje' => $validar->errors(),
                'status' => 0
            ]);
        }
        $model = new registros();
        $response = $model->search_registros_by_date($request->desde,$request->hasta);
        return response()->json([
            'data' => $response,
            'mje' => "Datos de consulta",
            'status' => 1
        ]);
    }
    public function search_by_id(Request $request){
        $model = new registros();
        $salida = $model->search_registro_by_id($request->idregistro);
        return $salida;

    }
}

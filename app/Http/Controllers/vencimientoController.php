<?php

namespace App\Http\Controllers;

use App\Models\vencimientos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class vencimientoController extends Controller
{
    public function insert_reg(Request $camp){
        $mje = "";
        $validacion = validator::make($camp->all(),[
            'vencimiento'=>'required|date',
            'control'=>'required|integer',
            'vda'=>'required',
            'maquinas_idmaquina'=>'required|integer',
            'registros_idregistro'=>'required|integer',
            'producto_idproducto'=>'required|integer',
        ],['error vencimiento','error control', 'error vda', 'error maquina', 'error registro','error producto']);
        if ($validacion->fails()) {

         return response()->json([
                'mje'=>$validacion->errors(),
                'status'=>0,
                'data'=>$validacion
            ]);
        }
        $model = new vencimientos();
        $data = $model->store($camp);
        if ($data == 1) {
            $mje = "operacion completada con exito";
            $status =1;
        }else{
            $mje = "operacion a fallado";
            $status =0;
        }
        return response()->json([
            'mje'=>$mje,
            'status'=>$status,
            'data'=>$data
        ]);
    }
    public function edit_reg (Request $request){
        $data = [];
        $model = new vencimientos();
        $validar = validator::make($request->all(),[
            'idvencimiento' => 'required|integer',
            'vencimiento'=>'required|date',
            'control'=>'required|integer',
            'vda'=>'required',
            'maquinas_idmaquina'=>'required|integer',
            'registros_idregistro'=>'required|integer',
            'producto_idproducto'=>'required|integer',
        ]);
        if ($validar->fails()) {
            return response()->json([
                'mje'=>$validar->errors(),
                'status' => 0,
                'data' => $data
            ]);
        }
        //paso info al modelo
        $data = $model->edit($request);
        if ($data == 1){
            $mje = "Se modifico el registro";
            $status = 1;
        }else {
            $mje = "Error al intentar modificar el registro";
            $status = 0;
        }
        return response()->json([
            'mje' =>  $mje,
            'status' => $status,
            'data' => $data
        ]);

    }
    public function delete_reg(Request $id){
        $model = new vencimientos();
        $data = $model->remove($id);
        if ($data == 1) {
            $mje = "Elemento eliminado";
            $status = 1;
        }else {
            $mje = "Error al eliminar el registro";
            $status = 0;
        }
        return response()->json([
            'mje' => $mje,
            'status' => $status,
            'data' => $data
        ]);
    }

}

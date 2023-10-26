<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Exception;
class vencimientos extends Model
{
    use HasFactory;
    public function getKeyName()
    {
        return 'idvencimiento';
    }
    public function store(Request $request){
        try {
            $model = new vencimientos();
            $model->vencimiento = $request->vencimiento;
            $model->control= $request->control;
            $model->vda = $request->vda;
            $model->maquinas_idmaquina = $request->maquinas_idmaquina;
            $model->registros_idregistro = $request->registros_idregistro;
            $model->producto_idproducto = $request->producto_idproducto;
            $data = $model->save();
       } catch (Exception $e) {
           $data = $e;
       }
        return $data;
    }
    public function edit (Request $request){
        $model = vencimientos::find ($request->idvencimiento);
        try {
            $model->vencimiento = $request->vencimiento;
            $model->control= $request->control;
            $model->vda = $request->vda;
            $model->maquinas_idmaquina = $request->maquinas_idmaquina;
            $model->registros_idregistro = $request->registros_idregistro;
            $model->producto_idproducto = $request->producto_idproducto;
            $data = $model->save();
        } catch (Exception $e) {
            $data = $e;
        }
        return $data;
    }
    public function remove(Request $requestID){
        try {
            $data = vencimientos::destroy($requestID->idvencimiento);
        } catch (Exception $e) {
            $data = $e;
        }
        return $data;
    }
    public function get_vencimientos ($idregistro){
        return vencimientos::where('registros_idregistro',$idregistro)
                            ->leftJoin('maquinas','maquinas.idmaquina','=','vencimientos.maquinas_idmaquina')
                            ->leftjoin('productos','productos.idproducto','vencimientos.producto_idproducto')
                            ->select('vencimientos.*','maquinas.detalle as maquina','productos.codigo','productos.detalle')
                            ->get();
    }
}

<?php

namespace App\Models;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Exception;
class obs_maquinas extends Model
{

    use HasFactory;
    public function getKeyName()
    {
        return "idobs_maquina";
    }
    public function store(Request $request){
        try {
            if ($request->idobs_maquina != "") {
                $model = obs_maquinas::find($request->idobs_maquina);
            }else{
                $model = new obs_maquinas();
            }
            $model->detalle = $request->detalle_maquina;
            $model->peroxido = $request->peroxido;
            $model->maquina_idmaquina = $request->maquina_idmaquina;
            $model->registro_idregistro = $request->registro_idregistro;
            $salida = $model->save();

        } catch (Exception $e) {
            $salida = false;
        }
        return $salida;
    }
    public function delete_reg($idobs_maquina){
        return obs_maquinas::destroy($idobs_maquina);
    }
    public function get_eventos($idregistro){
       return obs_maquinas::where('registro_idregistro',$idregistro)
                            ->leftjoin('maquinas','maquinas.idmaquina','obs_maquinas.maquina_idmaquina')
                            ->select('obs_maquinas.*','maquinas.detalle as maquina')
                            ->get();
    }
    public function get_by_id($id)
    {
        return obs_maquinas::find($id);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class lavados extends Model
{
    use HasFactory;
    public function getKeyName()
    {
        return 'idlavado';
    }
    public function store(Request $request){

        if ($request->idlavado != ""){
           $lavado  = lavados::find($request->idlavado);
        }else {
            $lavado = new lavados();
        }
        $lavado->tipo = $request->tipo;
        $lavado->hora = $request->hora;
        $lavado->registro_idregistro = $request->idregistro;
        $lavado->equipo_idequipo = $request->idequipo;
        $lavado->tanque_idtanque = $request->idtanque;
        $lavado->save();
        return $lavado;
    }
    public function delete_id($idlavado){
        $salida = lavados::destroy($idlavado);
        return $salida;
    }
    public function get_lavados($idregistro){
        return lavados::where('registro_idregistro',$idregistro)
                        ->leftjoin('equipos','equipos.idequipo','lavados.equipo_idequipo')
                        ->leftjoin('tanques','tanques.idtanque','lavados.tanque_idtanque')
                        ->select('lavados.*','equipos.nombre_eq','tanques.nombre_tk')
                        ->get();
    }
}

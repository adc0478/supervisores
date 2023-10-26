<?php

namespace App\Models;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class stock_silos extends Model
{
    public function getKeyName()
    {
        return "idstock_silo";
    }
    public function store(Request $request){
        if ($request->idstock_silo != "") {
            $model = stock_silos::find($request->idstock_silo);
        }else {
            $model = new stock_silos();
        }
        $model->producto_idproducto = $request->producto_idproducto;
        $model->silo_idsilo = $request->silo_idsilo;
        $model->registro_idregistro = $request->idregistro;
        return $model->save();
    }
    public function delete_key($idstock_silo){
        return stock_silos::destroy($idstock_silo);
    }
    public function get_stock_silo($idregistro){
        return stock_silos::where('registro_idregistro',$idregistro)
                            ->leftjoin('silos','silos.idsilo','stock_silos.silo_idsilo')
                            ->leftjoin('productos','productos.idproducto','stock_silos.producto_idproducto')
                            ->select('stock_silos.*','silos.nombre_silo','productos.codigo','productos.detalle')
                            ->get();
    }
    use HasFactory;
}

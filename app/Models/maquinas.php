<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class maquinas extends Model
{
    use HasFactory;
    protected $fillable = [
        'detalle',
        'visible'
    ];
    public function getKeyName()
    {
        return 'idmaquina';
    }

    public function get_list($condicion = 1){
        if ($condicion == 2){
            return maquinas::all();
        }
        return maquinas::where('visible',$condicion)->get();
    }
    public function validar (Request $request){
        $salida = Validator::make($request->all(),[
            'detalle' => 'required'
        ]);
        if ($salida->fails()){
            $status = 0;
            $error = $salida->errors();
        }else{
            $status = 1;
            $error = "ok";
        };
        return [
            'status' => $status,
            'error' => $error
        ];
    }
    public function store(Request $request){
        $status = 1;
        $error = "ok";
        try {
            maquinas::updateOrCreate(['idmaquina' => $request->idmaquina],['visible' => true,'detalle'=>$request->detalle]);
        } catch (Exception $e) {
            $status = 0;
            $error = $e->getMessage();
        }
        return [
            'status' => $status,
            'error' => $error
        ];
    }
    public function remove_item(Request $request){
        $status = 1;
        $error ="ok";
        try {
            maquinas::updateOrCreate(['idmaquina' => $request->idmaquina],['visible' => false]);
        } catch (Exception $e) {
            $status = 0;
            $error =$e->getMessage();
        }
        return [
            'status'=>$status,
            'error' => $error
        ];
    }
}

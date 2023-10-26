<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Exception;

class equipos extends Model
{
    protected $fillable = [
        'nombre_eq',
        'visible'
    ];
    use HasFactory;
    public function getKeyName()
    {
        return "idequipo";
    }
    public function get_list($condicion = 1){
        if ($condicion == 2){
            return equipos::all();
        }
        return equipos::where('visible',$condicion)->get();
    }
    public function validar (Request $request){
        $salida = Validator::make($request->all(),[
            'nombre_eq' => 'required'
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
            equipos::updateOrCreate(['idequipo' => $request->idequipo],['visible' => true,'nombre_eq'=>$request->nombre_eq]);
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
            equipos::updateOrCreate(['idequipo' => $request->idequipo],['visible' => false]);
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

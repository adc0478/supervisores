<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class silos extends Model
{
    protected $fillable =[
        'nombre_silo',
        'visible'
    ];
    use HasFactory;
    public function getKeyName()
    {
        return "idsilo";
    }
    public function get_list($condicion = 1){
        if ($condicion == 2){
            return silos::all();
        }
        return silos::where('visible',$condicion)->get();
    }
    public function validar (Request $request){
        $salida = Validator::make($request->all(),[
            'nombre_silo' => 'required'
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
            silos::updateOrCreate(['idsilo' => $request->idsilo],['visible' => true,'nombre_silo'=>$request->nombre_silo]);
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
            silos::updateOrCreate(['idsilo' => $request->idsilo],['visible' => false]);
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

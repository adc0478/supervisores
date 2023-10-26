<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Exception;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class productos extends Model
{
    use HasFactory;
    protected $fillable = [
        'codigo',
        'vida_util',
        'detalle',
        'visible'
    ];

    public function getKeyName()
    {
        return 'idproducto';
    }
    public function get_productos(){
        return productos::all();
    }
     public function get_list($condicion = 1){
         if ($condicion == 2){
             return productos::all();
        }
        return productos::where('visible',$condicion)->get();
    }
    public function validar (Request $request){
        $salida = Validator::make($request->all(),[
            'codigo' => 'required',
            'vida_util' =>'required|integer',
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
            productos::updateOrCreate(['idproducto' => $request->idproducto],[
            'visible' => true,
            'codigo'=>$request->codigo,
            'detalle' => $request->detalle,
            'vida_util' => $request->vida_util
            ]);
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
            productos::updateOrCreate(['idproducto' => $request->idproducto],['visible' => false]);
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

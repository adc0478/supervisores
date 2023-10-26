<?php

namespace App\Models;
use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class tanques extends Model
{
    use HasFactory;
    protected $fillable = [
        'nombre_tk',
        'visible'
    ];
    public function getKeyName()
    {
        return "idtanque";
    }

     public function get_list($condicion = 1){
         if ($condicion == 2){
             return tanques::all();
        }
        return tanques::where('visible',$condicion)->get();
    }
    public function validar (Request $request){
        $salida = Validator::make($request->all(),[
            'nombre_tk' => 'required'
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
            tanques::updateOrCreate(['idtanque' => $request->idtanque],['visible' => true,'nombre_tk'=>$request->nombre_tk]);
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
            tanques::updateOrCreate(['idtanque' => $request->idtanque],['visible' => false]);
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

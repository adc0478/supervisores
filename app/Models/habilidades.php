<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class habilidades extends Model
{
    protected $fillable = [
        'user_iduser',
        'habilidades'
    ];
    use HasFactory;
   public function get_list($condicion = 1){
        return User::select('habilidades.*','users.name','users.email','users.id as iduser')
                ->Leftjoin('habilidades','habilidades.user_iduser','users.id')
                ->get();
    }
    public function validar (Request $request){
        $salida = Validator::make($request->all(),[
            'user_iduser' => 'required',
            'habilidades' => 'required'
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
            habilidades::updateOrCreate(['user_iduser' => $request->user_iduser],['habilidades'=>$request->habilidades]);
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
            habilidades::updateOrCreate(['id'=>$request->id],['habilidades'=>""]);
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

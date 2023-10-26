<?php

namespace App\Models;
use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Stmt\TryCatch;

class registros extends Model
{
    protected $fillable = ['fecha','turno','fecha_fin'];
    use HasFactory;
    public function getKeyName(){
        return "idregistro";
    }
    public function store(Request $request){
        try {
            $model = new registros();
            $model->fecha = $request->fecha;
            $model->turno = $request->turno;
            $model->fecha_fin = $request->fecha_fin;
            $model->user_iduser = auth()->user()->id;
            $response = $model->save();
        } catch (Exception $e) {
            $response = $e;
        }
        return $response;
    }
    public function delete_reg(Request $request)
    {
        try {
            $response = registros::where("idregistro","=",$request['idregistro'])->delete();
        } catch (Exception $e) {
             $response = $e;
        }
        return $response;
    }
    public function modify(Request $request){
        $data = registros::find($request->idregistro);
        if (isset($data->idregistro)){
            $data->idregistro = $request->idregistro;
            $data->fecha = $request->fecha;
            $data->turno = $request->turno;
            $data->fecha_fin = $request->fecha_fin;
            $data->save();
        }
        return $data;
    }
    public function exist_reg_open (){
        $id = auth()->user()->id;
        $model = new registros();
        $data = $model->where('user_iduser',$id)->where('fecha_fin',Null)->get();
        if (isset($data[0]->idregistro)){
            return true;
        }else{
            return false;
        }
    }
    public function search_pending(){
        $data =[];
        $data = registros::where('user_iduser',auth()->user()->id)
                         ->where('fecha_fin',Null)
                         ->get();
        return $data;
    }
    public function search_registros_by_date($fecha_desde, $fecha_hasta){
        $response = registros::whereBetween('fecha',[$fecha_desde,$fecha_hasta])
                            ->join('users','users.id','registros.user_iduser')
                            ->select('registros.idregistro','registros.fecha','registros.turno','users.name','users.email')
                            ->get();
        return $response;
    }
    public function condiciones ($variable){
        if ($variable == ""){
           $signo = "<>";
        }else{
            $signo = "=";
        }
        return ['valor' =>$variable, 'signo' => $signo];
    }
    public function search_registro_by_id($id){
        return registros::select('registros.*','users.name')
                            ->leftjoin('users','users.id','registros.user_iduser')
                            ->find($id);
    }
}

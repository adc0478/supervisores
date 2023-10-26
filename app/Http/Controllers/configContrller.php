<?php

namespace App\Http\Controllers;

use App\Models\equipos;
use App\Models\habilidades;
use App\Models\maquinas;
use App\Models\productos;
use App\Models\silos;
use App\Models\tanques;
use App\Models\User;
use Illuminate\Http\Request;

class configContrller extends Controller
{
    public function instancia($dato)
    {
       switch ($dato) {
           case 'equipos':
               return new equipos();
               break;
           case 'silos':
               return new silos();
               break;
           case 'maquinas':
                return new maquinas();
               break;
            case 'tanques':
                return new tanques();
               break;
            case 'productos':
                return new productos();
               break;
            case 'userAdd':
                return new User();
               break;
            case 'userAbility':
                return new habilidades();
                break;
           default:
                return "";
               break;
       };
    }
    public function insertar_config(Request $request){
        //instanciar
        $model = $this->instancia($request['tipo']);
        $validar = $model->validar($request);
        if ($validar['status'] == 1){
            $response = $model->store($request);
        }else{
            $response = $validar;
        }
        return response()->json($response);
    }
    public function borrar_config(Request $request){
        $model = $this->instancia($request['tipo']);
        $validar = $model->validar($request);
        if ($validar['status'] == 1){
            $response = $model->remove_item($request);
        }else{
            $response = $validar;
        }

        return response()->json($response);
    }
    public function view_component(Request $request){
        $model = $this->instancia($request['tipo']);
        $datos = $model->get_list(2);
        //retornar la vista
        return view($request['tipo'],['data'=>$datos]);
    }
}

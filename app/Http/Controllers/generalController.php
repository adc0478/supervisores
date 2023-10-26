<?php

namespace App\Http\Controllers;

use Exception;
use App\Mail\superMail;
use App\Models\equipos;
use App\Models\lavados;
use App\Models\maquinas;
use App\Models\obs_maquinas;
use App\Models\productos;
use App\Models\registros;
use App\Models\silos;
use App\Models\stock_silos;
use App\Models\tanques;
use App\Models\vencimientos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class generalController extends Controller
{
    public function search_form_vencimiento(Request $data){
        //buscar maquinas
            $model_maquina = new maquinas();
            $maquinas = $model_maquina->get_list();
        //buscar productos
            $model_productos = new productos();
            $productos = $model_productos->get_productos();
        //buscar lista de vencimiento cargados por el usuario
            $model_lista = new vencimientos();
            $lista =$model_lista->get_vencimientos($data['idregistro']);

        //devolver respuesta
            return response()->json([
                'maquinas' => $maquinas,
                'productos' => $productos,
                'lista' => $lista
            ]);
    }
    public function search_form_lavado(Request $data){
        //buscar equipos
        $model_equipos = new equipos();
        $equipos = $model_equipos->get_list();
        //buscar tanques
        $model_tanques = new tanques();
        $tanques = $model_tanques->get_list();
        //buscar lista de lavados segun idregistro
        $model_lavado = new lavados();
        $lista = $model_lavado->get_lavados($data['idregistro']);
        return response()->json([
            'lavados' => $lista,
            'equipos' => $equipos,
            'tanques' => $tanques
        ]);
    }
    public function search_form_stock(Request $data){
        //buscar silos
        $model_silos = new silos();
        $silos = $model_silos->get_list();
        //buscar productos
        $model_productos = new productos();
        $productos = $model_productos->get_productos();
        //buscar lista de stock segun idregistro
        $model_stock = new stock_silos();
        $stocks = $model_stock->get_stock_silo($data->idregistro);
        return response()->json([
            'silos' => $silos,
            'productos' => $productos,
            'stock' => $stocks
        ]);
    }
    public function search_form_obs_maquina(Request $data){
        //buscar maquinas
        $model_maquina = new maquinas();
        $maquinas = $model_maquina->get_list();
        //listar los eventos de maquina por idregistro
        $model_eventos = new obs_maquinas();
        $eventos = $model_eventos->get_eventos($data->idregistro);
        //Retornar una respuesta
        return response()->json([
            'maquinas' => $maquinas,
            'lista' => $eventos
        ]);
    }
   /**
    * @param request type Request en el request debe recibir idregistro
    * @return void
    */
   public function search_all(Request $request)
   {
        //Buscar vencimientos
        $model_vto = new vencimientos();
        $vencimientos = $model_vto->get_vencimientos($request->idregistro);
        //Buscar lavados
        $model_lavado = new lavados();
        $lavados = $model_lavado->get_lavados($request->idregistro);
        //Buscar stocks
        $model_stock = new stock_silos();
        $stocks = $model_stock->get_stock_silo($request->idregistro);
        //Buscar observaciones
        $model_obs = new obs_maquinas();
        $obs = $model_obs->get_eventos($request->idregistro);
        //buscar registro
        $model_registro = new registros();
        $registro = $model_registro->search_registro_by_id($request->idregistro);
        return [
            'vencimientos' => $vencimientos,
            'lavados' => $lavados,
            'stocks' => $stocks,
            'observaciones' => $obs,
            'registros' => $registro
        ];
   }
    public function info_html(Request $request){
        $data = $this->search_all($request);
        $html = new httpController($data);
        return $html->create_html();
    }
    public function send_mail(Request $request){
        $error = "";
        $data = $this->search_all($request);
        $http = new httpController($data);
        $correo = new superMail($http->parametros);
        try {
            Mail::to('adc.0478@gmail.com')->send($correo);
            $response  = 1;
        } catch (Exception $e) {
            $response = 0;
            $error = $e->getMessage();
        }
        return response()->json([
            'status' => $response,
            'error' => $error
        ]);

    }

}

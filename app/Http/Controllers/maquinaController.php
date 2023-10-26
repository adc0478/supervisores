<?php

namespace App\Http\Controllers;

use App\Models\maquinas;
use Illuminate\Http\Request;

class maquinaController extends Controller
{
    public $model;
    public function __construct()
    {
        $this->model = new maquinas();
    }
    public function ingresar(Request $request){


    }
    public function listar(Request $request){

    }

    public function vista(){

    }
}

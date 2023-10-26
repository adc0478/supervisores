<?php

namespace App\Http\Controllers;

use App\Models\equipos;
use Illuminate\Http\Request;

class equiposController extends Controller
{
     public $model;
    public function __construct()
    {
        $this->model = new equipos();
    }
    public function ingresar(Request $request){


    }
    public function listar(Request $request){

    }

    public function vista(){

    }
}

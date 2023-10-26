<?php

namespace App\Http\Controllers;

use App\Models\productos;
use Illuminate\Http\Request;

class productosController extends Controller
{
     public $model;
    public function __construct()
    {
        $this->model = new productos();
    }
    public function ingresar(Request $request){


    }
    public function listar(Request $request){

    }

    public function vista(){

    }
}

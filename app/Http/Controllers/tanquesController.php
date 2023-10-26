<?php

namespace App\Http\Controllers;

use App\Models\tanques;
use Illuminate\Http\Request;

class tanquesController extends Controller
{
    public $model;
    public function __construct()
    {
        $this->model = new tanques();
    }
    public function ingresar(Request $request){


    }
    public function listar(Request $request){

    }

    public function vista(){

    }
}

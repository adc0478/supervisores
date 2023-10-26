<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\equipos;
use App\Models\habilidades;
use App\Models\maquinas;
use App\Models\productos;
use App\Models\silos;
use App\Models\tanques;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
       $this->model_productos('3575', 'Botella entera', 150);
       $this->model_productos('3576', 'Botella semi', 150);
       $this->model_productos('3587', 'Botella 0 lactoza', 150);

        $this->model_maquinas('SpeedA');
        $this->model_maquinas('PET');
        $this->model_maquinas('Edge');

        $this->model_equipos('stork7');
        $this->model_equipos('stork8');
        $this->model_equipos('stork9');
        $this->model_equipos('stork10');
        $this->model_equipos('stt1');
        $this->model_equipos('stt2');
        $this->model_equipos('Gea');

        $this->model_silos('ES1');
        $this->model_silos('ES2');
        $this->model_silos('ES3');
        $this->model_silos('ES4');
        $this->model_silos('ES5');
        $this->model_silos('ES8');
        $this->model_silos('ES9');

        $this->model_tanques('TK11');
        $this->model_tanques('TK8');
        $this->model_tanques('TK9');
        $this->model_tanques('TK10');

        $this->model_user_adm();
    }
    public function model_productos($codigo, $detalle, $vidaU){
        $model = new productos();
        $model->codigo = $codigo;
        $model->detalle = $detalle;
        $model->vida_util = $vidaU;
        $model->visible = true;
        $model->save();
    }
    public function model_maquinas($detalle){
        $model = new maquinas();
        $model->detalle = $detalle;
        $model->visible = true;
        $model->save();
    }
    public function model_equipos($name){
        $model = new equipos();
        $model->nombre_eq = $name;
        $model->visible = true;
        $model->save();
    }
    public function model_silos($name){
        $model = new silos();
        $model->nombre_silo = $name;
        $model->visible = true;
        $model->save();
    }
     public function model_tanques($name){
        $model = new tanques();
        $model->nombre_tk = $name;
        $model->visible = true;
        $model->save();
    }
    public function model_user_adm(){
        $model = new User();
        $model->name="ariel";
        $model->email ="adc.0478@gmail.com";
        $model->password = Hash::make('123');
        $model->save();
        $model2 = new habilidades();
        $model2->user_iduser = $model->id;
        $model2->habilidades = "admin";
        $model2->save();
    }
}

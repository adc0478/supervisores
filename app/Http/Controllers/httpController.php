<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class httpController extends Controller

{
    public $parametros;
    public $vencimiento;
    public $registro;
    public $observacion;
    public $lavados;
    public $stock;
    public $tabla ="margin-left:20%;margin-top:5px;border:1px solid black";
    public $tr ='color:white;background:rgba(59, 130, 246, 1)';
    public $trc ='paddin:3px;border:1px solid black';
    public $encabezado = 'display:grid;grid-template-colums:1fr 1fr 1fr';
    public $h2 = 'margin-top:10px;font-weight:bold;';
    /**
     * @param $listas
     */
    public function __construct($listas)
    {
        $this->vencimiento = $listas['vencimientos'];
        $this->registro = $listas['registros'];
        $this->observacion = $listas['observaciones'];
        $this->lavados = $listas['lavados'];
        $this->stock = $listas['stocks'];
        $this->parametros =[
            'vencimiento'=>$listas['vencimientos'],
            'registro' => $listas['registros'],
            'observacion' =>$listas['observaciones'],
            'lavado' =>$listas['lavados'],
            'stock' =>$listas['stocks']
        ];
    }

    /**
     * undocumented function
     *
     * @return void
     */
    public function create_html()
    {
        $pagina = "";
        //crear encabezado
        $pagina .= $this->set_encabezado();
        //crear lavados
        $pagina .= $this->set_lavados();
        //crear observacion
        $pagina .= $this->set_obs();
        //cerar vencimiento
        $pagina .= $this->set_vto();
        //crear stock
        $pagina .= $this->set_stock();
        //return $pagina;
        return view('responseHtml',$this->parametros,['bto'=>"true"]);
    }
    public function set_encabezado(){
        $print = "<div id='encabezado' style=".$this->encabezado. ">";
        $print .= "<label><strong>Nombre:</strong> " . $this->registro->name . "</label>";
        $print .= "<label><strong>Fecha:</strong> " . $this->registro->fecha . "</label>";
        $print .= "<label><strong>Turno:</strong> " . $this->registro->turno . "</label>";
        $print .= "</div>";
        return $print;
    }
    public function set_lavados(){
        $print = "<h2 style='".$this->h2."'>Lavados</h2>";
        $print .= "<table style='".$this->tabla."'>";
        $print .= "<tr style='".$this->tr."'>";
        $print .= "<th>Equipo</th>";
        $print .= "<th>tk</th>";
        $print .= "<th>Hora</th>";
        $print .= "<th>Tipo</th>";
        $print .="</tr>";
        foreach ($this->lavados as $data) {
            $print .= "<tr style='".$this->trc."'>";
            $print .="<td>" . $data->nombre_eq . "</td>";
            $print .="<td>" . $data->nombre_tk . "</td>";
            $print .="<td>" . $data->hora . "</td>";
            $print .="<td>" . $data->tipo . "</td>";
            $print .= "</tr>";
        }
        $print .="</table>";
        return $print;
    }
    public function set_obs(){

        $print = "<h2 style='".$this->h2 ."'>Maquinas</h2>";
        $print .= "<table style='".$this->tabla."'>";
        $print .= "<tr style='".$this->tr."'>";
        $print .= "<th>Maquina</th>";
        $print .= "<th>Observacion</th>";
        $print .= "<th>Peroxido</th>";
        $print .="</tr>";
        foreach ($this->observacion as $data) {
            $print .= "<tr style='".$this->trc."'>";
            $print .="<td>" . $data->maquina . "</td>";
            $print .="<td style='max-width:400px;word-break: break-all;'>" . $data->detalle . "</td>";
            $print .="<td style='color:red;text-align:center'>" . $data->peroxido . "</td>";
            $print .= "</tr>";
        }
        $print .="</table>";
        return $print;

    }
    public function set_vto(){
        $print = "<h2 style='".$this->h2."'>Control vencimiento</h2>";
        $print .= "<table style='".$this->tabla."'>";
        $print .= "<tr style='".$this->tr."'>";
        $print .= "<th>Maquina</th>";
        $print .= "<th>Codigo</th>";
        $print .= "<th>Vencimiento</th>";
        $print .= "<th>Ctr</th>";
        $print .= "<th>VDA</th>";
        $print .="</tr>";
        foreach ($this->vencimiento as $data) {
            $print .= "<tr style='".$this->trc."'>";
            $print .="<td>" . $data->maquina . "</td>";
            $print .="<td>" . $data->codigo . "</td>";
            $print .="<td>" . $data->vencimiento . "</td>";
            $print .="<td>" . $data->control . "</td>";
            $print .="<td>" . $data->vda . "</td>";
            $print .= "</tr>";
        }
        $print .="</table>";
        return $print;
    }
    public function set_stock(){
       $print = "<h2 style='".$this->h2."'>Stock</h2>";
        $print .= "<table style='".$this->tabla."'>";
        $print .= "<tr style='".$this->tr."'>";
        $print .= "<th>Silo</th>";
        $print .= "<th>Producto</th>";
        $print .="</tr>";
        foreach ($this->stock as $data) {
            $print .= "<tr style='".$this->trc."'>";
            $print .="<td>" . $data->nombre_silo . "</td>";
            $print .="<td>" . $data->detalle . "</td>";
            $print .= "</tr>";
        }
        $print .="</table>";
        return $print;
    }


}

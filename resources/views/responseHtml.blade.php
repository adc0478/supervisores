<div id="contenido">
        <style type="text/css" media="screen">
            table{
                margin-left:3rem;
                margin-top: 2rem;
                border: 1px solid black;
                overflow: auto;
            }
            #header{
                color:white;
                background:rgba(59, 130, 246, 1);
            }
            tr{
                border: 1px solid black;
                text-align: center;
            }
            a{
               width: 60px;
                height: 30px;
                background-color: white;
                box-shadow: 2px 2px 4px 0px rgba(1,1,1,0.6);
                color: blue;
                font-weight: bold;
                cursor: pointer;
                display: grid;
                align-content: center;
                text-align: center;
                margin-top: 2rem;
                margin-left: 3rem;
                border-radius: 5px;
                border: 0.5px solid navajowhite;
            }
            .btn{
                display:flex;
                flex-direction: row;
            }


        </style>
        <h1>Informe cambio  de turno</h1>

        <!--Cabecera -->
        <div style="display:flex; flex-direction:column;margin-top: 15px;">
           <span><strong>Nombre: </strong>{{$registro->name}}</span>
           <span><strong>Turno: </strong>{{$registro->turno}}</span>
           <span><strong>Fecha: </strong>{{$registro->fecha}}</span>
        </div>

        <!--Vencimiento -->
        <h2 style="margin-top:2rem;">Control de vencimiento</h2>
        <table>
           <tr id="header">
               <th>Maquina</th>
               <th>Codigo</th>
               <th>Vencimiento</th>
               <th>Control</th>
               <th>VDA</th>
           </tr>
           @foreach ($vencimiento as $date)
                <tr>
                    <td>{{$date->maquina}}</td>
                    <td>{{$date->codigo}}</td>
                    <td>{{$date->vencimiento}}</td>
                    <td>{{$date->control}}</td>
                    <td>{{$date->vda}}</td>
                </tr>
            @endforeach

        </table>
        <!--Lavado -->
        <h2 style="margin-top:2rem;">Control de lavados</h2>
        <table>
            <tr id="header">
                <th>Equipo</th>
                <th>Tanque</th>
                <th>Hora</th>
                <th>Tipo</th>
            </tr>
            @foreach($lavado as $date)
               <tr>
                   <td>{{$date->nombre_eq}}</td>
                   <td>{{$date->nombre_tk}}</td>
                   <td>{{$date->hora}}</td>
                   <td>{{$date->tipo}}</td>
               </tr>
            @endforeach
        </table>
        <!--Stock -->
        <h2 style="margin-top:2rem;">Control de Stocks</h2>
        <table>
            <tr id="header">
                <th>silo</th>
                <th>Producto</th>
            </tr>
            @foreach($stock as $date)
               <tr>
                   <td>{{$date->nombre_silo}}</td>
                   <td>{{$date->detalle}}</td>
               </tr>
            @endforeach
        </table>
        <!--Observacion-->
     <h2 style="margin-top:2rem;">Observacion maquina</h2>
        <table>
            <tr id="header">
                <th>Maquina</th>
                <th>Observacion</th>
                <th>Peroxido</th>
            </tr>
            @foreach($observacion as $date)
               <tr>
                   <td>{{$date->maquina}}</td>
                   <td style='max-width:400px;word-break: break-all;'>{{$date->detalle}}</td>
                   <td style='color:red;text-align:center'>{{$date->peroxido}}</td>
               </tr>
            @endforeach
        </table>
        @if(isset($bto))
            <div class="btn">
                <a onclick="send_mail({{$registro->idregistro}})">Mail</a>
                <a onclick="print_pdf('#contenido')">PDF</a>
            </div>
        @endif
       <script src="js/html2pdf.js/dist/html2pdf.bundle.min.js"></script>
       <script src="js/help.js" charset="utf-8"></script>
 </div>

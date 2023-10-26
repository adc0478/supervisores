<div class="container w-full md:w-3/4 mx-auto mt-10">
    <h1 class="font-black font-mono text-2xl shadow-md text-center">Configurar productos</h1>
    <form onsubmit="return false" class="grid grid-cols-1 w-full md:w-1/2 mx-auto gap-3 p-1">

            <div class="mb-4">
                <label for="idproducto" class="block font-medium">ID equipo</label>
                <input type="text" id="idproducto" name="idproducto" class="w-full border-gray-300 rounded-md shadow-sm py-2 px-3">
            </div>
            <div class="mb-4">
                <label for="codigo" class="block font-medium">Codigo</label>
                <input type="text" id="codigo" name="codigo" class="w-full border-gray-300 rounded-md shadow-sm py-2 px-3">
            </div>
            <div class="mb-4">
                <label for="detalle" class="block font-medium">Descripcion</label>
                <input type="text" id="detalle" name="detalle" class="w-full border-gray-300 rounded-md shadow-sm py-2 px-3">
            </div>
            <div class="mb-4">
                <label for="vida_util" class="block font-medium">Codigo</label>
                <input type="number" id="vida_util" name="vida_util" class="w-full border-gray-300 rounded-md shadow-sm py-2 px-3">
            </div>
                <button type="submit" onclick="registrar_config('productos')" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded">Guardar</button>
                <button type="submit" onclick="borrar_config('productos')" class="bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded">Borrar</button>

    </form>
            <table class="mt-8 w-full md:w-3/4 mx-auto border-2 border-black p-3">
                <thead>
                    <tr class="bg-yellow-100 text-gray-400">
                        <th class="px-4 py-2">ID</th>
                        <th class="px-4 py-2">Codigo</th>
                        <th class="px-4 py-2">Detalle</th>
                        <th class="px-4 py-2">Vida util</th>
                        <th class="px-4 py-2"></th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Filas de la tabla aquí -->
                    @foreach($data as $fila)

                        <tr class=@if($fila->visible == 0)
                                    "text-center bg-red-400 text-white"
                                  @else
                                   "text-center"
                                  @endif
                        </tr>
                            <td>{{$fila->idproducto}}</td>
                            <td>{{$fila->codigo}}</td>
                            <td>{{$fila->detalle}}</td>
                            <td>{{$fila->vida_util}}</td>
                            <td class="grid grid-cols-2">
                                <a onclick="editar_equipo('productos',[{{$fila->idproducto}}, '{{$fila->codigo}}','{{$fila->detalle}}',{{$fila->vida_util}}])" class="w-8 shadow-md text-center text-white cursor-pointer"><img class="mx-auto" src="img/edit.svg"></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

</div>

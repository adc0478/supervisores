<div class="container w-full md:w-3/4 mx-auto mt-10">
    <h1 class="font-black font-mono text-2xl shadow-md text-center">Configurar equipos</h1>
    <form onsubmit="return false" class="grid grid-cols-1 w-full md:w-1/2 mx-auto gap-3 p-1">

            <div class="mb-4">
                <label for="idequipo" class="block font-medium">ID equipo</label>
                <input type="text" id="idequipo" name="idequipo" class="w-full border-gray-300 rounded-md shadow-sm py-2 px-3">
            </div>
            <div class="mb-4">
                <label for="nombre_eq" class="block font-medium">Nombre</label>
                <input type="text" id="nombre_eq" name="nombre_eq" class="w-full border-gray-300 rounded-md shadow-sm py-2 px-3">
            </div>
                <button type="submit" onclick="registrar_config('equipos')" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded">Guardar</button>
                <button type="submit" onclick="borrar_config('equipos')" class="bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded">Borrar</button>

    </form>
            <table class="mt-8 w-full md:w-3/4 mx-auto border-2 border-black p-3">
                <thead>
                    <tr class="bg-yellow-100 text-gray-400">
                        <th class="px-4 py-2">ID</th>
                        <th class="px-4 py-2">nombre</th>
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
                            <td>{{$fila->idequipo}}</td>
                            <td>{{$fila->nombre_eq}}</td>
                            <td class="grid grid-cols-2">
                                <a onclick="editar_equipo('equipos',[{{$fila->idequipo}},'{{$fila->nombre_eq}}'])" class="w-8 shadow-md text-center text-white cursor-pointer"><img class="mx-auto" src="img/edit.svg"></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

</div>

<div class="container w-full md:w-3/4 mx-auto mt-10">
    <h1 class="font-black font-mono text-2xl shadow-md text-center">Configurar habilidades</h1>
    <form onsubmit="return false" class="grid grid-cols-1 w-full md:w-1/2 mx-auto gap-3 p-1">

            <div class="mb-4">
                <label for="id" class="block font-medium">ID</label>
                <input type="text" id="id" name="id" class="w-full border-gray-300 rounded-md shadow-sm py-2 px-3">
            </div>
            <div class="mb-4">
                <label for="user_iduser" class="block font-medium">ID usuario</label>
                <input type="text" id="user_iduser" name="user_iduser" class="w-full border-gray-300 rounded-md shadow-sm py-2 px-3">
            </div>
            <div class="mb-4">
                <label for="habilidades" class="block font-medium">Habilidades</label>
                <input type="text" id="habilidades" name="habilidades" class="w-full border-gray-300 rounded-md shadow-sm py-2 px-3">
            </div>
                <button type="submit" onclick="registrar_config('userAbility')" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded">Guardar</button>
                <button type="submit" onclick="borrar_config('userAbility')" class="bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded">Borrar</button>

    </form>
            <table class="mt-8 w-full md:w-3/4 mx-auto border-2 border-black p-3">
                <thead>
                    <tr class="bg-yellow-100 text-gray-400">
                        <th class="px-4 py-2">ID</th>
                        <th class="px-4 py-2">ID user</th>
                        <th class="px-4 py-2">Nombre</th>
                        <th class="px-4 py-2">Habilidad</th>
                        <th class="px-4 py-2"></th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Filas de la tabla aquí -->
                    @foreach($data as $fila)
                            <td>{{$fila->id}}</td>
                            <td>{{$fila->user_iduser}}</td>
                            <td>{{$fila->name}}</td>
                            <td>{{$fila->habilidades}}</td>
                            <td class="grid grid-cols-2">
                                <a onclick="editar_equipo('userAbility',[{{$fila->id}},'{{$fila->iduser}}','{{$fila->habilidades}}'])" class="w-8 shadow-md text-center text-white cursor-pointer"><img class="mx-auto" src="img/edit.svg"></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

</div>

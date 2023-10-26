<div class="container w-full md:w-3/4 mx-auto mt-10">
    <h1 class="font-black font-mono text-2xl shadow-md text-center">Cargar usuario</h1>
    <form onsubmit="return false" class="grid grid-cols-1 w-full md:w-1/2 mx-auto gap-3 p-1">
            <div class="mb-4">
                <label for="id" class="block font-medium">ID</label>
                <input type="text" id="id" name="id" class="w-full border-gray-300 rounded-md shadow-sm py-2 px-3">
            </div>
            <div class="mb-4">
                <label for="name" class="block font-medium">Nombre</label>
                <input type="text" id="name" name="name" class="w-full border-gray-300 rounded-md shadow-sm py-2 px-3">
            </div>
            <div class="mb-4">
                <label for="email" class="block font-medium">Email</label>
                <input type="text" id="email" name="email" class="w-full border-gray-300 rounded-md shadow-sm py-2 px-3">
            </div>
            <input type="password" value="123" class="hidden" name="password" id="password"/>
                <button type="submit" onclick="registrar_config('userAdd')" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded">Guardar</button>
                <button type="submit" onclick="borrar_config('userAdd')" class="bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded">Borrar</button>

    </form>
            <table class="mt-8 w-full md:w-3/4 mx-auto border-2 border-black p-3">
                <thead>
                    <tr class="bg-yellow-100 text-gray-400">
                        <th class="px-4 py-2">ID</th>
                        <th class="px-4 py-2">nombre</th>
                        <th class="px-4 py-2">email</th>
                        <th class="px-4 py-2"></th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Filas de la tabla aquí -->
                    @foreach($data as $fila)
                            <td>{{$fila->id}}</td>
                            <td>{{$fila->name}}</td>
                            <td>{{$fila->email}}</td>
                            <td class="grid grid-cols-2">
                                <a onclick="editar_equipo('userAdd',[{{$fila->id}},'{{$fila->name}}','{{$fila->email}}'])" class="w-8 shadow-md text-center text-white cursor-pointer"><img class="mx-auto" src="img/edit.svg"></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

</div>

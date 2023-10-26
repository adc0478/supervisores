<div class="container w-full md:w-3/4 mx-auto mt-10">
    <h1 class="font-black font-mono text-2xl shadow-md text-center">Cambiar password</h1>
    <form onsubmit="return false" class="grid grid-cols-1 bg-white w-full md:w-1/2 mx-auto gap-3 p-2 rounded-md mt-3">
            <div class="mb-4">
                <label for="email" class="block font-medium">Email</label>
                <input type="email" id="email" name="email"  class="w-full border-gray-300 rounded-md shadow-sm py-2 px-3">
            </div>
            <div class="mb-4">
                <label for="password_actual" class="block font-medium">Password actual</label>
                <input type="password" id="password_actual" name="password_actual" class="w-full border-gray-300 rounded-md shadow-sm py-2 px-3">
            </div>
            <div class="mb-4">
                <label for="password" class="block font-medium">Nuevo password</label>
                <input type="password" id="password" name="password" class="w-full border-gray-300 rounded-md shadow-sm py-2 px-3">
            </div>
            <div class="mb-4">
                <label for="password_confirmation" class="block font-medium">Confirmar password</label>
                <input type="password" id="password_confirmation" name="password_confirmation" class="w-full border-gray-300 rounded-md shadow-sm py-2 px-3">
            </div>
                <button type="submit" onclick="re_password()" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded">Confirmar</button>

    </form>

</div>

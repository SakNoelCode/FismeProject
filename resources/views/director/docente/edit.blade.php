<x-app-layout>
    <div class="py-8">
    <div class="mx-auto sm:px-4 py-10 bg-slate-300 mr-14 ml-14 rounded-3xl" >
        
        <div class="mb-4">
            <div class="mb-4">
                <h1><strong style="color: blue">FORMULARIO DE DOCENTES</strong></h1>
            </div>
        </div>
        <form action="/docentes/{{$docente->id}}" method="post">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="grid gap-7 mb-6 ">
                    <div>
                        <label for="" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Apellidos Docente <small style="color: rgb(5, 68, 241)">(Campo Obligatorio)</small></label>
                        <input type="text" name="apellidos" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="ingrese sus apellidos" required value="{{$docente->apellidos}}">
                    </div>
                    <div>
                        <label for="" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nombre Docente <small style="color: rgb(5, 68, 241)">( Campo Obligatorio)</small></label>
                        <input type="text" name="nombres" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="ingresar su nombre" required value="{{$docente->nombres}}">
                    </div>
                </div>
            </div>
            <div class="grid gap-6 mb-6">
                <div>
                    <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email <small style="color: rgb(5, 68, 241)">( Campo Obligatorio)</small></label>
                    <input type="text" name="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Email ingresar aqui" required value="{{$docente->email}}">
                </div>  
                <div>
                    <label for="telefono" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Telefono<small style="color: rgb(5, 68, 241)">( Campo Obligatorio)</small></label>
                    <input type="text" id="telefono" name="telefono" maxlength="9" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="ingresar numero telefonico" required value="{{$docente->telefono}}">
                </div>
                <div>
                    <label for="website" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Cargo <small style="color: rgb(5, 68, 241)">( Campo Obligatorio)</small></label>
                    <input type="text" name="especialidad" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="especialidad docente" required value="{{$docente->especialidad}}">
                </div>
            </div>
            <div class="mb-4"> </div>
            <div class="mb-2 text-center">
                <button type="submit" class="text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2" >Guardar</button>
                <a href="{{route('docentes.index')}}" class="text-white bg-gradient-to-r from-red-400 via-red-500 to-red-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">Cancelar</a>
    
            </div>
        </form>
   
</div>
</div>
</x-app-layout>
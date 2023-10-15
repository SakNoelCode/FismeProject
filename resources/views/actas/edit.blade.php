<x-app-layout>
    <div class="py-8">
    <div class="mx-auto sm:px-4 py-10 bg-slate-300 mr-14 ml-14 rounded-3xl" >
        
        <div class="mb-4">
            <div class="mb-4">
                <h1><strong style="color: blue">FORMULARIO DE EDICION DE ACTAS</strong></h1>
            </div>
        </div>
        <form action="/actas/{{$acta->id}}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="grid gap-7 mb-6 ">
                    <div>
                        <label for="" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Titulo <small style="color: rgb(5, 68, 241)">(Campo Obligatorio)</small></label>
                        <input type="text" name="titulo" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="ingrese sus apellidos" required value="{{$acta->titulo}}">
                    </div>
                    <div>
                        <label for="" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Fecha <small style="color: rgb(5, 68, 241)">( Campo Obligatorio)</small></label>
                        <input type="datetime" name="fecha" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="ingresar su nombre" required value="{{$acta->fecha}}">
                    </div>
                </div>
            </div>
            <div class="grid gap-6 mb-6">
                <div>
                    <option value="">Seleccione... </option>
                        <select class="form-control" name="estado" style="border-radius: 5px;">
                            <option value="Aprobado">Aprobado</option>
                            <option value="Desaprobado">Desaprobado</option>
                        </select>
                </div>  
                <div>
                    <label for="observaciones" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Observaciones<small style="color: rgb(5, 68, 241)">( Campo Obligatorio)</small></label>
                    <input type="text" id="observaciones" name="observaciones" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="ingresar numero telefonico" required value="{{$acta->observaciones}}">
                </div>
                <div>
                    <label for="website" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Archivo: <small style="color: rgb(5, 68, 241)">( Campo Obligatorio)</small></label>
                    <input type="file" name="pdf" accept=".pdf" id="pdf"  size="20000" class="bg-blue-50 border text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-100 dark:border-gray-100 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required value="{{$acta->pdf}}">
                </div>
                <div>
                    <label for="website" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nombres: <small style="color: rgb(5, 68, 241)">( Campo Obligatorio)</small></label>
                    <select name="practicante_id" id="practicante_id">
                        @foreach ($practicantes as $practicante)
                            <option value="{{$practicante->id}}">{{$practicante->nombres}} {{$practicante->apellidos}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="mb-4"> </div>
            <div class="mb-2 text-center">
                <button type="submit" class="text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2" >Guardar</button>
                <a href="{{route('actas.index')}}" class="text-white bg-gradient-to-r from-red-400 via-red-500 to-red-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">Cancelar</a>
    
            </div>
        </form>
   
</div>
</div>
</x-app-layout>
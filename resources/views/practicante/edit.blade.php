<x-app-layout>
    <div class="py-8 bg-teal-400">
        <div class="mx-auto sm:px-4 py-10 bg-cyan-50 mr-14 ml-14 rounded-2xl">
          
            <form action="/practicantes/{{$practicante->id}}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
                <div class="row">
                    <div class="mb-4">
                        <h1><strong style="color: blue">FORMULARIO DE EDICIÓN DE PLANES DE PRÁCTICAS</strong></h1>
                    </div>
                    <div class="grid gap-7 mb-6 ">
                        <div>
                            <label for="" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Fecha:<small style="color: rgb(5, 68, 241)">(Campo Obligatorio)</small></label>
                            <input type="date" id="fecha" name="fecha" readonly class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"  required value="{{$practicante->fecha}}">
                        </div>
                        <script>
                            var fechaActual = new Date().toISOString().split('T')[0];
                            document.getElementById("fecha").value = fechaActual;
                        </script>
                        <div>
                            <label for="" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Fecha Sustentación:<small style="color: rgb(5, 68, 241)">(Campo Obligatorio)</small></label>
                            <input type="date" id="fecha_sustentacion" name="fecha_sustentacion" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"  required value="{{$practicante->fecha_sustentacion}}">
                        </div>
                        <div>
                            <label for="" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Hora Sustentación:<small style="color: rgb(5, 68, 241)">(Campo Obligatorio)</small></label>
                            <input type="time" id="hora_sustentacion" name="hora_sustentacion" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"  required value="{{$practicante->hora_sustentacion}}">
                        </div>
                        <div>
                            <label for="" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tramite: <small style="color: rgb(5, 68, 241)">( Campo Obligatorio)</small></label>
                            <input type="text" name="tramite" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="registrar aquí" value="{{$practicante->tramite}}">
                        </div>
                        <div>
                            <label for="" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Dirigido: <small style="color: rgb(5, 68, 241)">( Campo Obligatorio)</small></label>
                            <select name="dirigido" class="rounded-xl">
                                <option value="Decanato">Decanato</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="grid gap-6 mb-6">
                    <div>
                        <label for="" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Código Estudiante<small style="color: rgb(5, 68, 241)">( Campo Obligatorio)</small></label>
                        <input type="text" name="codigo" maxlength="10" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="registrar aquí" value="{{$practicante->codigo}}">
                    </div>  
                    <div>
                        <label for="telefono" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Apellidos:<small style="color: rgb(5, 68, 241)">( Campo Obligatorio)</small></label>
                        <input type="text" name="apellidos" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="registrar aquí" value="{{$practicante->apellidos}}">
                    </div>
                    <div>
                        <label for="website" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nombres: <small style="color: rgb(5, 68, 241)">( Campo Obligatorio)</small></label>
                        <input type="text" name="nombres" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="registrar aquí" value="{{$practicante->nombres}}">
                    </div>
                </div>
                <div class="grid gap-6 mb-6">
                    <div>
                        <label for="" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Facultad: <small style="color: rgb(5, 68, 241)">( Campo Obligatorio)</small></label>
                        <select name="facultad" id="" class="rounded-xl">
                            {{-- <option value=" ">Seleccione: </option> --}}
                            <option value="facultad">Ingenieria de sistemas y mecánica eléctrica</option>
                        </select>
                    </div>  
                    <div>
                        <label for="telefono" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Escuela:<small style="color: rgb(5, 68, 241)">( Campo Obligatorio)</small></label>
                        <select name="escuela" id="" class="rounded-xl">
                            {{-- <option value=" ">Seleccione: </option> --}}
                            <option value="escuela">Ingenieria de sistemas</option>
                        </select>
                    </div>
                </div>
                <div class="grid gap-6 mb-6">
                    <div>
                        <label for="" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email Estudiante: <small style="color: rgb(5, 68, 241)">( Campo Obligatorio)</small></label>
                        <input type="email" name="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="registrar aquí" value="{{$practicante->email}}">
                    </div>  
                    <div>
                        <label for="telefono" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Telefono:<small style="color: rgb(5, 68, 241)">( Campo Obligatorio)</small></label>
                        <input type="text" name="telefono" maxlength="9" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="registrar aquí" value="{{$practicante->telefono}}">
                    </div>
                    <div>
                        <label for="website" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Dirección: <small style="color: rgb(5, 68, 241)">( Campo Obligatorio)</small></label>
                        <input type="text" name="direccion" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="registrar aquí" value="{{$practicante->direccion}}">
                    </div>
                </div>
                <div class="grid gap-6 mb-6">
                    <div>
                        <label for="docente_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Asesor: <small style="color: rgb(5, 68, 241)">( Campo Obligatorio)</small></label>
                        <select name="docente_id" id="docente_id" class="rounded-xl">
                            @foreach ($docentes as $docente)
                                <option value="{{ $docente->id }}">{{$docente->nombres }} {{ $docente->apellidos }}</option>
                            @endforeach
                        </select>
                        {{-- @if($docente->nombres)
                        <div>
                            <label>Nombre es : </label>
                            {{$docente->nombres}}
                        </div>
                        @endif --}}
                    </div>  
                    <div>
                        <label for="telefono" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Fundamentación:<small style="color: rgb(5, 68, 241)">( Campo Obligatorio)</small></label>
                        <input type="text" name="fundamentacion" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="registrar aquí" value="{{$practicante->fundamentacion}}">
                    </div>
                    {{-- <div>
                        <label class="col-lg-3 control-label" >Cargar Archivo <b>.PDF</b>  <small style="color: #59A805;font-size: 11pt;"><i>(Max 20 MB)</i></small> :</label>
                        <input type="file" name="pdf" accept=".pdf" class="form-control" id="pdf"  size="20000" value="{{$practicante->archivo}}">
                    </div> --}}
                    <div>
                        <label class="col-lg-3 control-label">Cargar Archivo <b>.PDF</b> <small style="color: #59A805;font-size: 11pt;"><i>(Max 20 MB)</i></small>:</label>
                        <input type="file" name="pdf" accept=".pdf" class="form-control" id="pdf" size="20000">
                    </div>
                    
                    @if($practicante->archivo)
                        <div>
                            <label>Archivo actual: </label>
                            {{$practicante->archivo}}
                        </div>
                    @endif
                    
                    <div>
                        <label for="website" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Folios: <small style="color: rgb(5, 68, 241)">( Campo Obligatorio)</small></label>
                        <input type="text" name="folios" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-blue-500 block w-full p-2.5 dark:bg-green-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="registrar aquí" value="{{$practicante->folios}}">
                    </div>
                    <div>
                        <label for="website" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Etapa: <small style="color: rgb(5, 68, 241)">( Campo Obligatorio) </small> seleccione una opción</label>
                        <select name="etapa" id="" class="rounded-2xl">
                            <option value="inicio">Inicio</option>
                            <option value="sustentato">Sustentado</option>
                            <option value="finalizado">Finalizado</option>
                            <option value="observado">Observado</option>
                        </select>
                    </div>
                    <div>
                        <label for="website" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Estado: <small style="color: rgb(5, 68, 241)">( Campo Obligatorio)</small> seleccione una opción</label>
                        <select name="estado" id="" class="rounded-2xl">
                            <option value="neutro">Neutro</option>
                            <option value="aprobado">Aprobado</option>
                            <option value="desaprobado">Desaprobado</option>
                        </select>
                    </div>

                    <div>
                        <label class="col-lg-3 control-label">Cargar Resolución: <b>.PDF</b> <small style="color: #051da8;font-size: 11pt;"><i>(Max 20 MB)</i></small>:</label>
                        <input type="file" name="resolucion" accept=".pdf"  id="pdf" size="20000" class="rounded-lg">
                    </div>
                </div>
                <div class="mb-4"> </div>
                <div class="mb-2 text-center">
                    <button type="submit" class="text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2" >Guardar</button>
                    <a href="{{route('practicantes.index')}}" class="text-white bg-gradient-to-r from-red-400 via-red-500 to-red-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
    
</x-app-layout>
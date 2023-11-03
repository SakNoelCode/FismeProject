@extends('layouts.tramite.app-tramite')

@section('title','Crear nuevo expediente')

@section('content')
<section>
    <form action="{{route('tramite.storeExpedienteRemitente')}}" method="post" enctype="multipart/form-data">
        @csrf

        <div class="mx-auto max-w-screen-xl">
            <div class="space-y-8 lg:grid lg:grid-cols-3 sm:gap-6 xl:gap-10 lg:space-y-0">

                <div>
                    <x-input-label for='asunto' value='Asunto(*):' class="text-xs" />
                    <x-text-input class="text-xs mt-2 block w-full" type='text' id="asunto" required name='asunto' autocomplete='asunto' :value="old('asunto')" />
                    <x-input-error class="mt-2 text-xs" :messages="$errors->get('asunto')" />
                </div>

                <div>
                    <x-input-label for='tipo_documento' value='Tipo de documento(*):' class="text-xs" />
                    <select class="text-xs mt-2 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" id="tipo_documento" name='tipo_documento' required autocomplete='tipo_documento'>
                        @php
                        $tiposDocumentos = ['oficio', 'carta', 'resolucion'];
                        @endphp

                        @foreach ($tiposDocumentos as $tipo)
                        <option value="{{ $tipo }}">{{ ucfirst($tipo) }}</option>
                        @endforeach

                    </select>
                    <x-input-error class="text-xs mt-2" :messages="$errors->get('tipo_documento')" />
                </div>

                <div>
                    <x-input-label for='area_id' value='Areá que recepcionará(*):' class="text-xs" />
                    <select class="text-xs mt-2 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" id="area_id" name='area_id' required autocomplete='area_id'>
                        @foreach ($areas as $area)
                        <option value="{{ $area->id }}">{{ $area->nombre }}</option>
                        @endforeach
                    </select>
                    <x-input-error class="text-xs mt-2" :messages="$errors->get('area_id')" />
                </div>

                <div>
                    <x-input-label for='documentos' value='Adjuntar Solo PDF(*):' class="text-xs" />
                    <x-text-input class="text-xs mt-2 block w-full" type='file' multiple id="documentos" name='documentos[]' accept=".pdf"/>
                    <x-input-error class="mt-2 text-xs" :messages="$errors->get('documentos')" />

                    <div class="text-xs mt-4">
                        <div id="lista-archivos"></div>
                    </div>

                    <script>
                        document.getElementById('documentos').addEventListener('change', function() {
                            var listaArchivos = document.getElementById('lista-archivos');
                            listaArchivos.innerHTML = '<h4 class="font-bold">Archivos adjuntados</h4>'; 

                            for (var i = 0; i < this.files.length; i++) {
                                var archivo = this.files[i];
                                var nombreArchivo = archivo.name;

                                var elementoLista = document.createElement('li');
                                elementoLista.textContent = nombreArchivo;

                                listaArchivos.appendChild(elementoLista);
                            }
                        });
                    </script>
                </div>

            </div>
        </div>

        <div class="mt-5 flex items-center gap-4">
            <x-primary-button>Enviar</x-primary-button>
        </div>
    </form>
</section>
@endsection
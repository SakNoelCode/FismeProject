<x-app-layout>
    <x-slot name="header">
        <!-- Breadcrumb -->
        <nav class="flex" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                    <a href="{{route('dashboard')}}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white">
                        <svg class="w-3 h-3 mr-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z" />
                        </svg>
                        Inicio
                    </a>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg class="w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4" />
                        </svg>
                        <a href="{{route('secretaria.expedientes.index')}}" class="ml-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ml-2 dark:text-gray-400 dark:hover:text-white">Expedientes</a>
                    </div>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <svg class="w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4" />
                        </svg>
                        <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2 dark:text-gray-400">Enviar documento</span>
                    </div>
                </li>
            </ol>
        </nav>
    </x-slot>

    @include('include.alert')


    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">


                    <section>
                        <header>
                            <h2 class="text-sm font-medium text-gray-900 dark:text-gray-100">
                                Trámite de expedientes internos
                            </h2>

                            <p class="mt-1 text-xs text-gray-600 dark:text-gray-400">
                                Envié documentación a cualquier areá de la Fisme
                            </p>
                        </header>


                        <form method="post" action="{{route('secretaria.expediente.storeEnviarDocumento')}}" class="mt-6 space-y-6" enctype="multipart/form-data">
                            @csrf

                            <div>
                                <x-input-label for="asunto" :value="__('Asunto:')" class="text-xs" />
                                <x-text-input id="asunto" name="asunto" type="text" class="mt-1 block w-full text-xs" :value="old('asunto')" required autofocus />
                                <x-input-error class="mt-2 text-xs" :messages="$errors->get('name')" />
                            </div>

                            <div>
                                <x-input-label for="tipo_documento_id" :value="__('Tipo de documento:')" class="text-xs" />
                                <select name="tipodocumento_id" id="tipodocumento_id" class="text-xs mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" required>

                                    @foreach ($tipodocumentos as $tipo)
                                    <option value="{{ $tipo->id }}" @selected(old('tipo_documento')==$tipo->id)>{{ ucfirst($tipo->nombre) }}</option>
                                    @endforeach
                                </select>
                                <x-input-error class="mt-2 text-xs" :messages="$errors->get('tipodocumento_id')" />
                            </div>

                            <div>
                                <x-input-label for="area_id" :value="__('Area a enviar:')" class="text-xs" />
                                <select name="area_id" id="area_id" class="text-xs mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" required>
                                    @foreach ($areas as $area)
                                    <option value="{{ $area->id }}" @selected(old('area_id')==$area->id)>{{ $area->nombre }}</option>
                                    @endforeach
                                </select>
                                <x-input-error class="mt-2 text-xs" :messages="$errors->get('area_id')" />
                            </div>

                            <div>
                                <x-input-label for='documentos' value='Adjuntar Solo PDF(*):' class="text-xs" />
                                <x-text-input class="text-xs mt-2 block w-full" type='file' multiple id="documentos" name='documentos[]' accept=".pdf" />
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



                            <div class="flex items-center gap-4">
                                <x-primary-button>Enviar</x-primary-button>
                            </div>
                        </form>
                    </section>

                </div>
            </div>
        </div>
    </div>





</x-app-layout>
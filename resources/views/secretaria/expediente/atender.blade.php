<x-app-layout>

    <x-slot name="header">
        <!-- Breadcrumb -->
        <nav class="flex" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                    <a href="{{ route('dashboard') }}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white">
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
                        <a href="{{ route('secretaria.expedientes.index') }}" class="ml-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ml-2 dark:text-gray-400 dark:hover:text-white">Expedientes</a>
                    </div>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <svg class="w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4" />
                        </svg>
                        <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2 dark:text-gray-400">Atender expediente</span>
                    </div>
                </li>
            </ol>
        </nav>
    </x-slot>

    @include('include.alert')

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <!----Encabezado--->
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <header>
                    <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                        Detalles del expediente
                    </h2>
                </header>

                <div class="mt-4">

                    <div class="md:flex mt-4">

                        <div class="md:w-1/2">

                            <!---Numero de expediente--->
                            <div class="flex mb-2">
                                <h2 class="text-sm font-bold mr-2">Número de expediente:</h2>
                                <p class="text-sm">{{$expediente->numeracion}}</p>
                            </div>

                            <!---Código se seguridad--->
                            <div class="flex mb-2">
                                <h2 class="text-sm font-bold mr-2">Código se seguridad:</h2>
                                <p class="text-sm">{{$expediente->codigo}}</p>
                            </div>

                            <!---Fecha recepción--->
                            <div class="flex mb-2">
                                <h2 class="text-sm font-bold mr-2">Fecha de recepción:</h2>
                                <p class="text-sm">{{date("d/m/Y", strtotime($expediente->fecha_recepcion))}}</p>
                            </div>

                            <!---Area a cargo--->
                            <div class="flex mb-2">
                                <h2 class="text-sm font-bold mr-2">Area a cargo:</h2>
                                <p class="text-sm">{{$expediente->area->nombre}}</p>
                            </div>

                            <!---Estado--->
                            <div class="flex mb-2">
                                <h2 class="text-sm font-bold mr-2">Estado:</h2>
                                <p class="text-sm">{{$expediente->estado}}</p>
                            </div>



                        </div>

                        <div class="md:w-1/2">
                            <!---Remitente--->
                            <div class="flex mb-2">
                                <h2 class="text-sm font-bold mr-2">Remitente:</h2>
                                <p class="text-sm">{{$expediente->remitente->razon_social}}</p>
                            </div>

                            <!---N° Documento--->
                            <div class="flex mb-2">
                                <h2 class="text-sm font-bold mr-2">N° Documento:</h2>
                                <p class="text-sm">{{$expediente->remitente->numero_documento}}</p>
                            </div>

                            <!--Correo--->
                            <div class="flex mb-2">
                                <h2 class="text-sm font-bold mr-2">Correo:</h2>
                                <p class="text-sm">{{$expediente->remitente->email}}</p>
                            </div>

                            <!--Tipo de documento--->
                            <div class="flex mb-2">
                                <h2 class="text-sm font-bold mr-2">Tipo de documento:</h2>
                                <p class="text-sm">{{$expediente->documento->tipo}}</p>
                            </div>

                            <!--Descripcion--->
                            <div class="flex mb-2">
                                <h2 class="text-sm font-bold mr-2">Descripción:</h2>
                                <p class="text-sm">{{$expediente->documento->descripcion}}</p>
                            </div>

                        </div>

                    </div>
                </div>
            </div>


            <!---Cuerpo--->
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">

                    <section>
                        <header>
                            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                Atender Expediente
                            </h2>

                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                Atender un expediente es dar una respuesta al remitente.
                            </p>
                        </header>



                        <form action="{{route('secretaria.expediente.historial.store',['expediente'=>$expediente])}}" class="mt-6 space-y-6" enctype="multipart/form-data" method="post">
                            @csrf
                            <div>
                                <x-input-label for="descripcion" :value="__('Escribe una respuesta al remitente *:')" />
                                <textarea name="descripcion" id="descripcion" rows="4" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm'" required autofocus>{{old('descripcion')}}</textarea>
                                <x-input-error class="mt-2" :messages="$errors->get('descripcion')" />
                            </div>

                            <div>
                                <x-input-label for="documento" :value="__('Adjuntar archivo (Solo archivos PDF - Opcional)')" />
                                <x-text-input accept=".pdf" id="documento" name="documento" type="file" class="mt-1 block w-full" :value="old('documento')" />
                                <x-input-error class="mt-2" :messages="$errors->get('documento')" />
                            </div>

                            <div class="flex items-center gap-4">
                                <x-primary-button>{{ __('Save') }}</x-primary-button>

                                @if (session('status') === 'historial-stored')
                                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-sm text-gray-600 dark:text-gray-400">{{ __('Guardado.') }}</p>
                                @endif
                            </div>
                        </form>
                    </section>


                </div>
            </div>


            <!---Tabla de Historiales--->
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">

                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <caption class="p-5 text-lg font-semibold text-left text-gray-900 bg-white dark:text-white dark:bg-gray-800">
                        Historial del expediente
                        <p class="mt-1 text-sm font-normal text-gray-500 dark:text-gray-400">
                            En la siguiente tabla se muestra todo el registro de cambios por el que ha pasado el expediente.
                        </p>
                        @if ($expediente->historiales->isEmpty())
                        <div class="px-6 py-4">
                            <p class="text-center text-base text-gray-900 dark:text-white">No hay registros</p>
                        </div>
                    </caption>
                    @else

                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Fecha y Hora
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Descripción
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Documento adjunto
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Encargado
                            </th>
                            <!--th scope="col" class="px-6 py-3">
                                <span class="sr-only">Edit</span>
                            </th--->
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($expediente->historiales as $item)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <th class="px-6 py-4">
                                {{date("d/m/Y", strtotime($item->fecha_hora))}} - {{date("H.i", strtotime($item->fecha_hora))}}
                            </th>
                            <td class="px-6 py-4">
                                {{$item->descripcion}}
                            </td>
                            <td class="px-6 py-4">
                                @if ($item->documento_adjunto)
                                <a target="_blank" href="{{route('secretaria.expediente.ver-pdf',['name'=>$item->documento_adjunto])}}">
                                    <svg class="w-[20px] h-[20px] text-blue-600 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 14">
                                        <g stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                                            <path d="M10 10a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" />
                                            <path d="M10 13c4.97 0 9-2.686 9-6s-4.03-6-9-6-9 2.686-9 6 4.03 6 9 6Z" />
                                        </g>
                                    </svg>
                                </a>
                                @else
                                No hay documento
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                {{$item->user->name}}
                            </td>
                            <!--td class="px-6 py-4 text-right">
                                <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                            </td--->
                        </tr>
                        @endforeach
                    </tbody>

                    @endif
                </table>
            </div>


/


        </div>
    </div>


</x-app-layout>
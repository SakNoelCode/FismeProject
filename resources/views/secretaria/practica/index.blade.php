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
                <li aria-current="page">
                    <div class="flex items-center">
                        <svg class="w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4" />
                        </svg>
                        <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2 dark:text-gray-400">Practicas</span>
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
                <header class="flex flex-wrap items-center gap-y-5">
                    <div class="w-full">
                        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                            Documentación prácticas preprofesionales
                        </h2>
                        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                            Reciba y recepcione los documentos de las prácticas preprofesionales de los estudiantes.
                        </p>
                    </div>
                </header>
            </div>


            <!---Cuerpo--->
            @if (!$practicas->count())
            <div class="px-6 py-4">
                <p class="text-center text-base text-gray-900 dark:text-white">Sin resultados</p>
            </div>
            @else
            @foreach ($practicas as $item)
            <div class="w-full bg-white border border-gray-200 rounded-lg shadow">
                <div class="sm:hidden">
                    <label for="tabs-{{$item->id}}" class="sr-only">Select tab</label>
                    <select id="tabs-{{$item->id}}" class="bg-gray-50 border-0 border-b border-gray-200 text-gray-900 text-sm rounded-t-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                        <option>Datos de la práctica</option>
                        <option>Datos del practicante</option>
                        <option>Documentos</option>
                    </select>
                </div>
                <ul class="hidden text-sm font-medium text-center text-gray-500 divide-x divide-gray-200 rounded-lg sm:flex rtl:divide-x-reverse" id="fullWidthTab-{{$item->id}}" data-tabs-toggle="#fullWidthTabContent-{{$item->id}}" role="tablist">
                    <li class="w-full">
                        <button id="practica-tab-{{$item->id}}" data-tabs-target="#practica-{{$item->id}}" type="button" role="tab" aria-controls="practica-{{$item->id}}" aria-selected="true" class="inline-block w-full p-4 rounded-ss-lg bg-gray-50 hover:bg-gray-100 focus:outline-none">
                            Datos de la práctica
                        </button>
                    </li>
                    <li class="w-full">
                        <button id="practicante-tab-{{$item->id}}" data-tabs-target="#practicante-{{$item->id}}" type="button" role="tab" aria-controls="practicante-{{$item->id}}" aria-selected="false" class="inline-block w-full p-4 bg-gray-50 hover:bg-gray-100 focus:outline-none">
                            Datos del practicante
                        </button>
                    </li>
                    <li class="w-full">
                        <button id="documentos-tab-{{$item->id}}" data-tabs-target="#documentos-{{$item->id}}" type="button" role="tab" aria-controls="documentos-{{$item->id}}" aria-selected="false" class="inline-block w-full p-4 rounded-se-lg bg-gray-50 hover:bg-gray-100 focus:outline-none">
                            Documentos
                        </button>
                    </li>
                </ul>
                <div id="fullWidthTabContent-{{$item->id}}" class="border-t border-gray-200">

                    <div class="hidden p-4 bg-white rounded-lg md:p-8" id="practica-{{$item->id}}" role="tabpanel" aria-labelledby="practica-tab-{{$item->id}}">
                        <dl class="grid max-w-screen-xl grid-cols-3 gap-8 p-2 mx-auto text-gray-900 sm:grid-cols-5 xl:grid-cols-5 sm:p-8">
                            <div class="flex flex-col items-center justify-center">
                                <dt class="mb-2 text-lg font-extrabold">{{$item->numeracion}}</dt>
                                <dd class="text-gray-500 dark:text-gray-400">Correlativo</dd>
                            </div>

                            <div class="flex flex-col items-center justify-center">
                                <dt class="mb-2 text-lgl font-extrabold">
                                    @if ($item->fecha_sustentacion === null)
                                    <a data-modal-target="fecha-modal-{{$item->id}}" data-modal-toggle="fecha-modal-{{$item->id}}" class="cursor-pointer font-medium text-blue-600 underline dark:text-blue-500 hover:no-underline">Asignar</a>
                                    @else
                                    <a data-modal-target="fecha-modal-{{$item->id}}" data-modal-toggle="fecha-modal-{{$item->id}}" class="cursor-pointer font-medium text-blue-600 underline dark:text-blue-500 hover:no-underline">
                                        {{date("d/m/Y", strtotime($item->fecha_sustentacion))}} - {{date("H:i", strtotime($item->fecha_sustentacion))}}
                                    </a>
                                    @endif
                                </dt>
                                <dd class="text-gray-500 dark:text-gray-400">Sustentación</dd>
                            </div>
                            <div class="flex flex-col items-center justify-center">
                                <dt class="mb-2 text-lg font-extrabold">
                                    <a data-modal-target="estado-modal-{{$item->id}}" data-modal-toggle="estado-modal-{{$item->id}}" class="cursor-pointer font-medium text-blue-600 underline dark:text-blue-500 hover:no-underline">
                                        {{ucfirst($item->estado)}}
                                    </a>
                                </dt>
                                <dd class="text-gray-500 dark:text-gray-400">Estado</dd>
                            </div>
                            <div class="flex flex-col items-center justify-center">
                                <dt class="mb-2 text-lg font-extrabold">
                                    <a data-modal-target="etapa-modal-{{$item->id}}" data-modal-toggle="etapa-modal-{{$item->id}}" class="cursor-pointer font-medium text-blue-600 underline dark:text-blue-500 hover:no-underline">
                                        {{ucfirst($item->etapa)}}
                                    </a>
                                </dt>
                                <dd class="text-gray-500 dark:text-gray-400">Etapa</dd>
                            </div>
                            <div class="flex flex-col items-center justify-center">
                                <dt class="mb-2 text-lg font-extrabold text-center">{{ucfirst($item->practicante->asesore->user->name)}}</dt>
                                <dd class="text-gray-500 dark:text-gray-400">Asesor</dd>
                            </div>
                        </dl>
                    </div>

                    <div class="hidden p-4 bg-white rounded-lg md:p-8" id="practicante-{{$item->id}}" role="tabpanel" aria-labelledby="practicante-tab-{{$item->id}}">
                        <ul role="list" class="space-y-4 text-gray-500 dark:text-gray-400">
                            <li class="flex space-x-2 rtl:space-x-reverse items-center">
                                <svg class="flex-shrink-0 w-3.5 h-3.5 text-blue-600 dark:text-blue-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z" />
                                </svg>
                                <span class="leading-tight">Nombres y apellidos: {{$item->practicante->razon_social}}</span>
                            </li>
                            <li class="flex space-x-2 rtl:space-x-reverse items-center">
                                <svg class="flex-shrink-0 w-3.5 h-3.5 text-blue-600 dark:text-blue-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z" />
                                </svg>
                                <span class="leading-tight">Código Universitario: {{$item->practicante->codigo_estudiante}}</span>
                            </li>
                            <li class="flex space-x-2 rtl:space-x-reverse items-center">
                                <svg class="flex-shrink-0 w-3.5 h-3.5 text-blue-600 dark:text-blue-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z" />
                                </svg>
                                <span class="leading-tight">Teléfono: {{$item->practicante->telefono}}</span>
                            </li>
                            <li class="flex space-x-2 rtl:space-x-reverse items-center">
                                <svg class="flex-shrink-0 w-3.5 h-3.5 text-blue-600 dark:text-blue-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z" />
                                </svg>
                                <span class="leading-tight">Escuela Profesional: {{$item->practicante->escuela->name}}</span>
                            </li>
                        </ul>
                    </div>

                    <div class="hidden p-4 bg-white rounded-lg" id="documentos-{{$item->id}}" role="tabpanel" aria-labelledby="documentos-tab-{{$item->id}}">


                        <a data-modal-target="resolucion-modal-{{$item->id}}" data-modal-toggle="resolucion-modal-{{$item->id}}" class="cursor-pointer inline-flex items-center font-medium text-blue-600 dark:text-blue-500 hover:underline mb-4 ml-4">
                            Subir resolución de prácticas
                            <svg class="w-4 h-4 ms-2 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9" />
                            </svg>
                        </a>

                        <div class="relative overflow-x-auto">
                            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                    <tr>
                                        <th scope="col" class="px-6 py-3">
                                            Tipo
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Documento
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($item->actas as $acta)
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{ucfirst($acta->tipoacta->descripcion)}}
                                        </th>
                                        <td class="px-6 py-4">
                                            <a target="_blank" href="{{ route('secretaria.practica.ver-pdf',['name'=>$acta->documento_path]) }}" class="font-medium text-blue-600 underline dark:text-blue-500 hover:no-underline">
                                                {{$acta->documento_path}}
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>


            <!-- Modal para la fecha -->
            <div id="fecha-modal-{{$item->id}}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <div class="relative p-4 w-full max-w-md max-h-full">
                    <!-- Modal content -->
                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                        <!-- Modal header -->
                        <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                Asignar fecha y hora de sustentación
                            </h3>
                            <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="fecha-modal-{{$item->id}}">
                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                </svg>
                                <span class="sr-only">Close modal</span>
                            </button>
                        </div>
                        <!-- Modal body -->
                        <form action="{{route('secretaria.practicas.updateSustentacion',['practica'=>$item->id])}}" class="p-4 md:p-5" method="post">
                            @csrf
                            <div class="grid gap-4 mb-4 grid-cols-2">
                                <div class="col-span-2">
                                    <label for="fecha_sustentacion" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Fecha de sustentación</label>
                                    <input type="date" name="fecha_sustentacion" id="fecha_sustentacion" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required="">
                                </div>
                                <div class="col-span-2">
                                    <label for="hora_sustentacion" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Hora de sustentación</label>
                                    <input type="time" name="hora_sustentacion" id="hora_sustentacion" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required="">
                                </div>

                            </div>
                            <button type="submit" class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                Guardar
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Modal para el estado -->
            <div id="estado-modal-{{$item->id}}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <div class="relative p-4 w-full max-w-md max-h-full">
                    <!-- Modal content -->
                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                        <!-- Modal header -->
                        <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                Asignar estado
                            </h3>
                            <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="estado-modal-{{$item->id}}">
                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                </svg>
                                <span class="sr-only">Close modal</span>
                            </button>
                        </div>
                        <!-- Modal body -->
                        <form action="{{route('secretaria.practicas.updateEstado',['practica'=>$item->id])}}" class="p-4 md:p-5" method="post">
                            @csrf
                            <div class="grid gap-4 mb-4 grid-cols-2">
                                <div class="col-span-2">
                                    <label for="estado" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Estado actual: {{ucfirst($item->estado)}}</label>
                                    <select name="estado" id="estado" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                        @php
                                        $tipos = ['Neutro', 'Aprobado', 'Desaprobado'];
                                        @endphp

                                        @foreach ($tipos as $tipo)
                                        <option value="{{ $tipo }}" {{ $tipo == $item->estado ? 'selected' : ''}}>{{ ucfirst($tipo) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <button type="submit" class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                Guardar
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Modal para la Etapa -->
            <div id="etapa-modal-{{$item->id}}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <div class="relative p-4 w-full max-w-md max-h-full">
                    <!-- Modal content -->
                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                        <!-- Modal header -->
                        <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                Asignar etapa
                            </h3>
                            <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="etapa-modal-{{$item->id}}">
                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                </svg>
                                <span class="sr-only">Close modal</span>
                            </button>
                        </div>
                        <!-- Modal body -->
                        <form action="{{route('secretaria.practicas.updateEtapa',['practica'=>$item->id])}}" class="p-4 md:p-5" method="post">
                            @csrf
                            <div class="grid gap-4 mb-4 grid-cols-2">
                                <div class="col-span-2">
                                    <label for="etapa" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Etapa actual: {{ucfirst($item->etapa)}}</label>
                                    <select name="etapa" id="etapa" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                        @php
                                        $tipos = ['Inicio', 'Sustentado', 'Finalizado','Observado'];
                                        @endphp

                                        @foreach ($tipos as $tipo)
                                        <option value="{{ $tipo }}" {{ $tipo == $item->etapa ? 'selected' : ''}}>{{ ucfirst($tipo) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <button type="submit" class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                Guardar
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Modal para subir la resolución -->
            <div id="resolucion-modal-{{$item->id}}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <div class="relative p-4 w-full max-w-md max-h-full">
                    <!-- Modal content -->
                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                        <!-- Modal header -->
                        <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                Subir resolución de prácticas
                            </h3>
                            <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="resolucion-modal-{{$item->id}}">
                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                </svg>
                                <span class="sr-only">Close modal</span>
                            </button>
                        </div>
                        <!-- Modal body -->
                        <form action="{{route('secretaria.practicas.loadFilePractica',['practica'=>$item->id])}}" class="p-4 md:p-5" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="grid gap-4 mb-4 grid-cols-2">
                                <div class="col-span-2">
                                    <label for="documento_path" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Subir archivo: </label>
                                    <input accept=".pdf" required type="file" name="documento_path" id="documento_path" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5">
                                </div>
                            </div>
                            <button type="submit" class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                Guardar
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach


            @if ($practicas->hasPages())
            <div class="px-6 py-4">
                {{ $proyectos->links() }}
            </div>
            @endif

            
            @endif

        </div>
    </div>



</x-app-layout>
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
                        <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2 dark:text-gray-400">Proyectos de tesis</span>
                    </div>
                </li>
            </ol>
        </nav>
    </x-slot>

    @include('include.alert')

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <header>
                    <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                        {{ __('Proyectos de tesis') }}
                    </h2>

                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                        {{ __("En este módulo podrás gestionar tus proyectos de tesis") }}
                    </p>
                </header>
            </div>


            <section class="bg-gray-50 dark:bg-gray-900">

                <div class="mx-auto max-w-screen-xl">

                    <!---Header Table--->
                    <div class="relative bg-white shadow-md dark:bg-gray-800 sm:rounded-lg">
                        <div class="flex flex-col items-center justify-between p-4 space-y-3 md:flex-row md:space-y-0 md:space-x-4">
                            <div class="w-full md:w-1/2">
                                <form class="flex items-center">
                                    <label for="simple-search" class="sr-only">Search</label>
                                    <div class="relative w-full">
                                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                            <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                        <input type="text" id="simple-search" class="block w-full p-2 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Buscar" required="">
                                    </div>
                                </form>
                            </div>
                            <div class="flex flex-col items-stretch justify-end flex-shrink-0 w-full space-y-2 md:w-auto md:flex-row md:space-y-0 md:items-center md:space-x-3">
                                <a href="#" role="button" class="flex items-center justify-center px-4 py-2 text-sm font-medium text-white rounded-lg bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                                    <svg class="h-3.5 w-3.5 mr-2" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                        <path clip-rule="evenodd" fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" />
                                    </svg>
                                    Nuevo registro
                                </a>
                                <div class="flex items-center w-full space-x-3 md:w-auto">
                                    <button id="actionsDropdownButton" data-dropdown-toggle="actionsDropdown" class="flex items-center justify-center w-full px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg md:w-auto focus:outline-none hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700" type="button">
                                        <svg class="-ml-1 mr-1.5 w-5 h-5" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                            <path clip-rule="evenodd" fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" />
                                        </svg>
                                        Acciones
                                    </button>
                                    <div id="actionsDropdown" class="z-10 hidden bg-white divide-y divide-gray-100 rounded shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
                                        <ul class="py-1 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="actionsDropdownButton">
                                            <li>
                                                <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Mass Edit</a>
                                            </li>
                                        </ul>
                                        <div class="py-1">
                                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Delete all</a>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    @if ($proyectos->count())
                    @foreach ($proyectos as $item)
                    <div class="w-full mt-4 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">

                        <!----Contenedores de opciones--->
                        <ul class="flex flex-wrap text-sm font-medium text-center text-gray-500 border-b border-gray-200 rounded-t-lg bg-gray-50 dark:border-gray-700 dark:text-gray-400 dark:bg-gray-800" id="defaultTab-{{$item->id}}" data-tabs-toggle="#defaultTabContent-{{$item->id}}" role="tablist">
                            <li class="mr-2">
                                <button id="about-tab-{{$item->id}}" data-tabs-target="#about-{{$item->id}}" type="button" role="tab" aria-controls="about" aria-selected="true" class="inline-block p-4 text-blue-600 rounded-tl-lg hover:bg-gray-100 dark:bg-gray-800 dark:hover:bg-gray-700 dark:text-blue-500">Acerca de</button>
                            </li>
                            <li class="mr-2">
                                <button id="services-tab-{{$item->id}}" data-tabs-target="#services-{{$item->id}}" type="button" role="tab" aria-controls="services" aria-selected="false" class="inline-block p-4 hover:text-gray-600 hover:bg-gray-100 dark:hover:bg-gray-700 dark:hover:text-gray-300">Seguimiento</button>
                            </li>
                            <li class="mr-2">
                                <button id="statistics-tab-{{$item->id}}" data-tabs-target="#statistics-{{$item->id}}" type="button" role="tab" aria-controls="statistics" aria-selected="false" class="inline-block p-4 hover:text-gray-600 hover:bg-gray-100 dark:hover:bg-gray-700 dark:hover:text-gray-300">Responsables</button>
                            </li>
                            <li class="mr-2">
                                <button id="resoluciones-tab-{{$item->id}}" data-tabs-target="#resoluciones-{{$item->id}}" type="button" role="tab" aria-controls="resoluciones" aria-selected="false" class="inline-block p-4 hover:text-gray-600 hover:bg-gray-100 dark:hover:bg-gray-700 dark:hover:text-gray-300">Resoluciones</button>
                            </li>
                        </ul>

                        <!----Opciones---->
                        <div id="defaultTabContent-{{$item->id}}">

                            <!---Acerca de---->
                            <div class="hidden p-4 bg-white rounded-lg md:p-8 dark:bg-gray-800" id="about-{{$item->id}}" role="tabpanel" aria-labelledby="about-tab-{{$item->id}}">
                                <h2 class="mb-3 text-3xl font-extrabold tracking-tight text-gray-900 dark:text-white">{{$item->name}}</h2>
                                <p class="mb-3 text-gray-500 dark:text-gray-400">{{ ($item->descripcion=='' ? 'Sin descripción' : $item->descripcion)}}</p>

                                @if ($item->fecha_inicio != '')
                                <p class="mb-3 text-gray-500 dark:text-gray-400">Tiempo de ejecución: {{date("d/m/Y", strtotime($item->fecha_inicio))}} - {{date("d/m/Y", strtotime($item->fecha_fin))}}</p>
                                @endif

                                <!-----Estado---->
                                @if ($item->estado == 0)
                                <span title="Estado" class="cursor-pointer bg-gray-100 text-gray-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-gray-300">No definido</span>
                                @endif
                                @if ($item->estado == 1)
                                <span title="Estado" class="cursor-pointer bg-green-100 text-green-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">Aprobado</span>
                                @endif
                                @if ($item->estado == -1)
                                <span title="Estado" class="cursor-pointer bg-red-100 text-red-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300">Desaprobado</span>
                                @endif

                                <!------Etapas--->
                                @if ($item->etapa_id == 1)
                                <span title="Etapa" class="cursor-pointer bg-blue-100 text-blue-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300">{{$item->etapa->name}}</span>
                                @endif
                                @if ($item->etapa_id == 2)
                                <span title="Etapa" class="cursor-pointer bg-gray-100 text-gray-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-gray-300">{{$item->etapa->name}}</span>
                                @endif
                                @if ($item->etapa_id == 3)
                                <span title="Etapa" class="cursor-pointer bg-blue-100 text-yellow-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-yellow-900 dark:text-yellow-300">{{$item->etapa->name}}</span>
                                @endif
                                @if ($item->etapa_id == 4)
                                <span title="Etapa" class="cursor-pointer bg-blue-100 text-purple-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-purple-900 dark:text-purple-300">{{$item->etapa->name}}</span>
                                @endif
                                @if ($item->etapa_id == 5)
                                <span title="Etapa" class="cursor-pointer bg-blue-100 text-pink-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-pink-900 dark:text-pink-300">{{$item->etapa->name}}</span>
                                @endif

                                <a href="{{(route('proyectoTesista.verEstado',['proyecto' => $item]))}}" class="inline-flex items-center font-medium text-blue-600 hover:text-blue-800 dark:text-blue-500 dark:hover:text-blue-700">
                                    Más información
                                    <svg class="w-2.5 h-2.5 ml-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4" />
                                    </svg>
                                </a>

                            </div>

                            <!----Seguimiento------------>
                            <div class="hidden p-4 bg-white rounded-lg md:p-8 dark:bg-gray-800" id="services-{{$item->id}}" role="tabpanel" aria-labelledby="services-tab-{{$item->id}}">

                                <h2 class="mb-5 text-2xl font-extrabold tracking-tight text-gray-900 dark:text-white">Cronograma de actividades</h2>

                                <!---Cabecera tabla--->
                                <div class="relative overflow-hidden bg-white shadow-md dark:bg-gray-700 sm:rounded-xl mb-3">
                                    <div class="flex-row items-center justify-between p-2 sm:flex">
                                        <div>
                                            <p class="text-gray-500 dark:text-gray-400">Recuerde completar todas las actividades de su cronograma para que pueda avanzar de etapa</p>
                                        </div>

                                        @if ($item->fecha_inicio == '')
                                        <button id="defaultModalButton" data-modal-toggle="defaultModal" type="button" class="flex items-center justify-center px-4 py-2 text-sm font-medium text-white rounded-lg bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                                            <svg class="w-3 h-3 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 8v10a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0Zm12 7h-1v1a1 1 0 0 1-2 0v-1H8a1 1 0 0 1 0-2h1v-1a1 1 0 1 1 2 0v1h1a1 1 0 0 1 0 2Z" />
                                            </svg>
                                            <span class="ml-3">Asignar fecha</span>
                                        </button>
                                        @else
                                        <button id="editarFechaModalButton" data-modal-toggle="editarFechaModal" type="button" class="flex items-center justify-center px-4 py-2 text-sm font-medium text-white rounded-lg bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                                            <svg class="w-3 h-3 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 8v10a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0Zm12 7h-1v1a1 1 0 0 1-2 0v-1H8a1 1 0 0 1 0-2h1v-1a1 1 0 1 1 2 0v1h1a1 1 0 0 1 0 2Z" />
                                            </svg>
                                            <span class="ml-3">Editar fecha</span>
                                        </button>
                                        @endif

                                    </div>
                                </div>


                                <!---Tabla de actividades----->
                                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                            <tr>
                                                <th scope="col" class="px-6 py-3">
                                                    Nombre
                                                </th>
                                                <th scope="col" class="px-6 py-3">
                                                    Fecha Inicio
                                                </th>
                                                <th scope="col" class="px-6 py-3">
                                                    Fecha fin
                                                </th>
                                                <th scope="col" class="px-6 py-3">
                                                    Estado
                                                </th>
                                                <th scope="col" class="px-6 py-3">
                                                    Tipo
                                                </th>
                                                <th scope="col" class="px-6 py-3">
                                                    <span class="sr-only">Edit</span>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($item->actividades as $actividad)
                                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50">
                                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                    {{$actividad->name}}
                                                </th>
                                                <td class="px-6 py-4">
                                                    {{date("d/m/Y", strtotime($actividad->fecha_inicio))}}
                                                </td>
                                                <td class="px-6 py-4">
                                                    {{date("d/m/Y", strtotime($actividad->fecha_fin))}}
                                                </td>
                                                <th scope="col" class="px-6 py-3">
                                                    @if ($actividad->estado === 'pendiente')
                                                    <span class="bg-yellow-100 text-yellow-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-yellow-900 dark:text-yellow-300">{{$actividad->estado}}</span>
                                                    @else
                                                    <span class="bg-green-100 text-green-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">{{$actividad->estado}}</span>
                                                    @endif
                                                </th>
                                                <td class="px-6 py-4">
                                                    @if ($actividad->is_entregable === 1)
                                                    <span class="bg-gray-100 text-gray-800 text-xs font-medium inline-flex items-center px-2.5 py-0.5 rounded mr-2 dark:bg-gray-700 dark:text-gray-400 border border-gray-500">
                                                        <svg class="w-2.5 h-2.5 mr-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                                            <path d="M10 0a10 10 0 1 0 10 10A10.011 10.011 0 0 0 10 0Zm3.982 13.982a1 1 0 0 1-1.414 0l-3.274-3.274A1.012 1.012 0 0 1 9 10V6a1 1 0 0 1 2 0v3.586l2.982 2.982a1 1 0 0 1 0 1.414Z" />
                                                        </svg>
                                                        Actividad
                                                    </span>
                                                    @else
                                                    <span class="bg-blue-100 text-blue-800 text-xs font-medium inline-flex items-center px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-blue-400 border border-blue-400">
                                                        <svg class="w-2.5 h-2.5 mr-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                                            <path d="M10 0a10 10 0 1 0 10 10A10.011 10.011 0 0 0 10 0Zm3.982 13.982a1 1 0 0 1-1.414 0l-3.274-3.274A1.012 1.012 0 0 1 9 10V6a1 1 0 0 1 2 0v3.586l2.982 2.982a1 1 0 0 1 0 1.414Z" />
                                                        </svg>
                                                        Entregable
                                                    </span>
                                                    @endif
                                                </td>
                                                <td class="px-6 py-4 text-right">
                                                    <a href="{{route('proyectoTesista.editActividad',['proyecto'=>$item,'actividad'=>$actividad])}}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>


                                <!---Boton para agregar nueva actividad--->
                                @if ($item->etapa_id == 3 && $item->estado == 1)
                                <a href="{{(route('proyectoTesista.crearActividad',['proyecto' => $item]))}}" class="mt-5 inline-flex items-center font-medium text-blue-600 hover:text-blue-800 dark:text-blue-500 dark:hover:text-blue-700">
                                    Añadir actividades
                                    <svg class="w-2.5 h-2.5 ml-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4" />
                                    </svg>
                                </a>
                                @endif

                            </div>

                            <!-----Responsables---->
                            <div class="hidden p-4 bg-white rounded-lg md:p-8 dark:bg-gray-800" id="statistics-{{$item->id}}" role="tabpanel" aria-labelledby="statistics-tab-{{$item->id}}">
                                <dl class="grid max-w-screen-xl grid-cols-2 gap-8 p-4 mx-auto text-gray-900 sm:grid-cols-3 xl:grid-cols-6 dark:text-white sm:p-8">
                                    <div class="flex flex-col">
                                        <dt class="mb-2 text-3xl font-extrabold">Tesista</dt>
                                        <dd class="text-gray-500 dark:text-gray-400">{{$item->tesista->user->name}}</dd>
                                    </div>
                                    <div class="flex flex-col">
                                        <dt class="mb-2 text-3xl font-extrabold">Asesor</dt>
                                        <dd class="text-gray-500 dark:text-gray-400">{{$item->asesor->user->name}}</dd>
                                    </div>
                                    <div class="flex flex-col">
                                        <dt class="mb-2 text-3xl font-extrabold">Empresa</dt>
                                        <dd class="text-gray-500 dark:text-gray-400">{{$item->empresa->name}}</dd>
                                    </div>
                                </dl>
                            </div>

                            <!-----Resoluciones---------->
                            <div class="hidden p-4 bg-white rounded-lg md:px-8 md:py-2 dark:bg-gray-800" id="resoluciones-{{$item->id}}" role="tabpanel" aria-labelledby="resoluciones-tab-{{$item->id}}">

                                @if (count($item->resoluciones))
                                <div class="relative overflow-x-auto">
                                    <!-- Cabecera -->
                                    <div class="relative overflow-hidden bg-white shadow-md dark:bg-gray-800 sm:rounded-lg">
                                        <div class="flex-row items-center justify-between p-4 space-y-3 sm:flex sm:space-y-0 sm:space-x-4">
                                            <div>
                                                <h5 class="mr-3 font-semibold dark:text-white">Resoluciones de decanato</h5>
                                                <p class="text-gray-500 dark:text-gray-400">Lista de las resoluciones del proyecto</p>
                                            </div>
                                        </div>
                                    </div>

                                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                            <tr>
                                                <th scope="col" class="px-6 py-3">
                                                    Tipo de resolución
                                                </th>
                                                <th scope="col" class="px-6 py-3">
                                                    Descripción
                                                </th>
                                                <th scope="col" class="px-6 py-3">
                                                    Documento
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($item->resoluciones as $resolucion)
                                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                    {{$resolucion->tipo}}
                                                </th>
                                                <td class="px-6 py-4">
                                                    {{$resolucion->descripcion}}
                                                </td>
                                                <td class="px-6 py-4">
                                                    <form action="{{route('resolucionTesista.download',['id'=>$resolucion->id])}}" method="post">
                                                        @csrf
                                                        <button type="submit" title="Descargar">
                                                            <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 16 20">
                                                                <path stroke="currentColor" stroke-linejoin="round" stroke-width="2" d="M6 1v4a1 1 0 0 1-1 1H1m14-4v16a.97.97 0 0 1-.933 1H1.933A.97.97 0 0 1 1 18V5.828a2 2 0 0 1 .586-1.414l2.828-2.828A2 2 0 0 1 5.828 1h8.239A.97.97 0 0 1 15 2Z" />
                                                            </svg>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                @else
                                <p class="my-5 text-gray-500 dark:text-gray-400">
                                    Aún no hay resoluciones en este proyecto
                                </p>
                                @endif
                            </div>

                        </div>
                    </div>
                    @endforeach


                    @else
                    <div class="px-6 py-4">
                        <p class="text-center text-base text-gray-900 dark:text-white">Sin resultados</p>
                    </div>
                    @endif

                </div>
            </section>

        </div>
    </div>




    <!----Modales--->

    <!-- modal para asignar una fecha al proyecto -->
    <div id="defaultModal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
        <div class="relative p-4 w-full max-w-2xl h-full md:h-auto">
            <!-- Modal content -->
            <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
                <!-- Modal header -->
                <div class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 dark:border-gray-600">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                        Asignar fecha al proyecto
                    </h3>
                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="defaultModal">
                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <form action="{{route('proyectoTesista.updateFecha',['proyecto'=>$proyectos->first()->id])}}" method="post">
                    @csrf
                    <div class="grid gap-4 mb-4 sm:grid-cols-2">
                        <div>
                            <label for="fecha_inicio" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Fecha inicio</label>
                            <input type="date" name="fecha_inicio" id="fecha_inicio" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required="">
                        </div>
                        <div>
                            <label for="fecha_fin" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Fecha fin</label>
                            <input type="date" name="fecha_fin" id="fecha_fin" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required="">
                        </div>
                    </div>
                    <button type="submit" class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Guardar
                    </button>
                </form>
            </div>
        </div>
    </div>


    <!-- modal para editar una fecha al proyecto -->
    <div id="editarFechaModal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
        <div class="relative p-4 w-full max-w-2xl h-full md:h-auto">
            <!-- Modal content -->
            <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
                <!-- Modal header -->
                <div class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 dark:border-gray-600">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                        Editar fecha del proyecto
                    </h3>
                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="editarFechaModal">
                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <form action="{{ route('proyectoTesista.updateFecha',['proyecto' => $proyectos->first()->id]) }}" method="post">
                    @csrf
                    <div class="grid gap-4 mb-4 sm:grid-cols-2">
                        <div>
                            <label for="fecha_inicio" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Fecha inicio</label>
                            <input type="date" value="{{$proyectos->first()->fecha_inicio}}" name="fecha_inicio" id="fecha_inicio" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required="">
                        </div>
                        <div>
                            <label for="fecha_fin" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Fecha fin</label>
                            <input type="date" value="{{$proyectos->first()->fecha_fin}}" name="fecha_fin" id="fecha_fin" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required="">
                        </div>
                    </div>
                    <button type="submit" class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Guardar
                    </button>
                </form>
            </div>
        </div>
    </div>

</x-app-layout>
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
                        <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2 dark:text-gray-400">Expedientes</span>
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
                    <div class="w-full lg:w-2/3">
                        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                            Expedientes
                        </h2>

                        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                            En este módulo podrá gestionar todo lo relacionado a la gestión de documentos y expedientes.
                        </p>


                        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                            Esta designada al área de:
                            <button data-popover-target="popover-area" type="button" class="bg-blue-100 text-blue-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300">
                                {{Auth::user()->secretaria->area->nombre}}
                            </button>
                        </p>

                        @switch(Auth::user()->secretaria->area->id)
                        @case(1)
                        <div data-popover id="popover-area" role="tooltip" class="absolute z-10 invisible inline-block w-64 text-sm text-gray-500 transition-opacity duration-300 bg-white border border-gray-200 rounded-lg shadow-sm opacity-0 dark:text-gray-400 dark:border-gray-600 dark:bg-gray-800">
                            <div class="px-3 py-2 bg-gray-100 border-b border-gray-200 rounded-t-lg dark:border-gray-600 dark:bg-gray-700">
                                <h3 class="font-semibold text-gray-900 dark:text-white">{{Auth::user()->secretaria->area->nombre}}</h3>
                            </div>
                            <div class="px-3 py-2">
                                <p>{{Auth::user()->secretaria->area->descripcion}}</p>
                            </div>
                            <div data-popper-arrow></div>
                        </div>
                        @break

                        @case(2)
                        <div data-popover id="popover-area" role="tooltip" class="absolute z-10 invisible inline-block w-64 text-sm text-gray-500 transition-opacity duration-300 bg-white border border-gray-200 rounded-lg shadow-sm opacity-0 dark:text-gray-400 dark:border-gray-600 dark:bg-gray-800">
                            <div class="px-3 py-2 bg-gray-100 border-b border-gray-200 rounded-t-lg dark:border-gray-600 dark:bg-gray-700">
                                <h3 class="font-semibold text-gray-900 dark:text-white">{{Auth::user()->secretaria->area->nombre}}</h3>
                            </div>
                            <div class="px-3 py-2">
                                <p>{{Auth::user()->secretaria->area->descripcion}}</p>
                            </div>
                            <div data-popper-arrow></div>
                        </div>
                        @break

                        @case(3)
                        <div data-popover id="popover-area" role="tooltip" class="absolute z-10 invisible inline-block w-64 text-sm text-gray-500 transition-opacity duration-300 bg-white border border-gray-200 rounded-lg shadow-sm opacity-0 dark:text-gray-400 dark:border-gray-600 dark:bg-gray-800">
                            <div class="px-3 py-2 bg-gray-100 border-b border-gray-200 rounded-t-lg dark:border-gray-600 dark:bg-gray-700">
                                <h3 class="font-semibold text-gray-900 dark:text-white">{{Auth::user()->secretaria->area->nombre}}</h3>
                            </div>
                            <div class="px-3 py-2">
                                <p>{{Auth::user()->secretaria->area->descripcion}}</p>
                            </div>
                            <div data-popper-arrow></div>
                        </div>
                        @break

                        @case(4)
                        <div data-popover id="popover-area" role="tooltip" class="absolute z-10 invisible inline-block w-64 text-sm text-gray-500 transition-opacity duration-300 bg-white border border-gray-200 rounded-lg shadow-sm opacity-0 dark:text-gray-400 dark:border-gray-600 dark:bg-gray-800">
                            <div class="px-3 py-2 bg-gray-100 border-b border-gray-200 rounded-t-lg dark:border-gray-600 dark:bg-gray-700">
                                <h3 class="font-semibold text-gray-900 dark:text-white">{{Auth::user()->secretaria->area->nombre}}</h3>
                            </div>
                            <div class="px-3 py-2">
                                <p>{{Auth::user()->secretaria->area->descripcion}}</p>
                            </div>
                            <div data-popper-arrow></div>
                        </div>
                        @break

                        @case(5)
                        <div data-popover id="popover-area" role="tooltip" class="absolute z-10 invisible inline-block w-64 text-sm text-gray-500 transition-opacity duration-300 bg-white border border-gray-200 rounded-lg shadow-sm opacity-0 dark:text-gray-400 dark:border-gray-600 dark:bg-gray-800">
                            <div class="px-3 py-2 bg-gray-100 border-b border-gray-200 rounded-t-lg dark:border-gray-600 dark:bg-gray-700">
                                <h3 class="font-semibold text-gray-900 dark:text-white">{{Auth::user()->secretaria->area->nombre}}</h3>
                            </div>
                            <div class="px-3 py-2">
                                <p>{{Auth::user()->secretaria->area->descripcion}}</p>
                            </div>
                            <div data-popper-arrow></div>
                        </div>
                        @break
                        @endswitch
                    </div>


                    <div class="w-full lg:w-1/3 lg:text-center">
                        <a href="{{route('secretaria.expediente.filtrarExpedientes')}}" class="mr-3 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                            Crear reportes
                        </a>
                    </div>

                </header>
            </div>

            <!---Buscador--->
            <div class="relative bg-white shadow-md dark:bg-gray-800 sm:rounded-lg">
                <div class="flex flex-col items-center justify-between p-4 space-y-3 md:flex-row md:space-y-0 md:space-x-4">
                    <div class="w-full md:w-1/2">
                        <form class="flex items-center" action="{{route('secretaria.expedientes.index')}}" method="get">
                            <label for="simple-search" class="sr-only">Search</label>
                            <div class="relative w-full">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                    <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <input type="text" value="{{$search}}" id="simple-search" name="search" class="block w-full p-2 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Buscar por número de expediente o remitente">
                            </div>
                        </form>
                    </div>
                    <div class="flex flex-col items-stretch justify-end flex-shrink-0 w-full space-y-2 md:w-auto md:flex-row md:space-y-0 md:items-center md:space-x-3">
                        <a href="{{route('secretaria.expediente.registrarExpedienteFisico')}}" role="button" class="flex items-center justify-center px-4 py-2 text-sm font-medium text-white rounded-lg bg-blue-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800">
                            <svg class="h-3.5 w-3.5 mr-2" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                <path clip-rule="evenodd" fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" />
                            </svg>
                            Registrar documento físico
                        </a>
                        <div class="flex items-center w-full space-x-3 md:w-auto">
                            <button id="actionsDropdownButton" data-dropdown-toggle="actionsDropdown" class="flex items-center justify-center w-full px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg md:w-auto focus:outline-none hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700" type="button">
                                <svg class="-ml-1 mr-1.5 w-5 h-5" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                    <path clip-rule="evenodd" fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" />
                                </svg>
                                Enviar documento
                            </button>
                            <div id="actionsDropdown" class="z-10 hidden bg-white divide-y divide-gray-100 rounded shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
                                <ul class="py-1 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="actionsDropdownButton">
                                    <li>
                                        <a href="{{route('secretaria.expediente.enviarDocumento')}}" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Por área</a>
                                    </li>
                                    <li>
                                        <a href="{{route('secretaria.expediente.enviarDocumentoDocente')}}" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Por docentes</a>
                                    </li>
                                </ul>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <!---Cuerpo--->
            <section class="bg-gray-50 dark:bg-gray-900">
                <div class="mx-auto max-w-screen-xl">

                    <!----Card--->
                    <div class="w-full bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                        <div class="sm:hidden">
                            <label for="tabs" class="sr-only">Select tab</label>
                            <select id="tabs" class="bg-gray-50 border-0 border-b border-gray-200 text-gray-900 text-sm rounded-t-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option>Recibidos</option>
                                <option>Enviados</option>
                            </select>
                        </div>
                        <ul class="hidden text-sm font-medium text-center text-gray-500 divide-x divide-gray-200 rounded-lg sm:flex dark:divide-gray-600 dark:text-gray-400 rtl:divide-x-reverse" id="fullWidthTab" data-tabs-toggle="#fullWidthTabContent" role="tablist">
                            <li class="w-full">
                                <button id="recibidos-tab" data-tabs-target="#recibidos" type="button" role="tab" aria-controls="stats" aria-selected="true" class="inline-block w-full p-4 rounded-ss-lg bg-gray-50 hover:bg-gray-100 focus:outline-none dark:bg-gray-700 dark:hover:bg-gray-600">Recibidos</button>
                            </li>
                            <li class="w-full">
                                <button id="enviados-tab" data-tabs-target="#enviados" type="button" role="tab" aria-controls="about" aria-selected="false" class="inline-block w-full p-4 bg-gray-50 hover:bg-gray-100 focus:outline-none dark:bg-gray-700 dark:hover:bg-gray-600">Enviados</button>
                            </li>
                        </ul>
                        <div id="fullWidthTabContent" class="border-t border-gray-200 dark:border-gray-600">
                            <div class="hidden p-4 bg-white rounded-lg md:p-8 dark:bg-gray-800" id="recibidos" role="tabpanel" aria-labelledby="recibidos-tab">

                                <!---Tabla--->
                                @if ($expedientes->isEmpty())
                                <div class="px-6 py-4">
                                    <p class="text-center text-base text-gray-900 dark:text-white">No hay registros</p>
                                </div>
                                @else
                                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                            <tr>
                                                <th scope="col" class="px-6 py-3">
                                                    N° Expediente
                                                </th>
                                                <th scope="col" class="px-6 py-3">
                                                    Tipo
                                                </th>
                                                <th scope="col" class="px-6 py-3">
                                                    Fecha de recepción
                                                </th>
                                                <th scope="col" class="px-6 py-3">
                                                    Asunto
                                                </th>
                                                <th scope="col" class="px-6 py-3">
                                                    Remitente
                                                </th>

                                                <th scope="col" class="px-6 py-3">
                                                    Ver documento
                                                </th>
                                                <th scope="col" class="px-6 py-3">
                                                    Proveído
                                                </th>
                                                <th scope="col" class="px-6 py-3">
                                                    Estado
                                                </th>
                                                <th scope="col" class="px-6 py-3 sr-only">
                                                    Acciones
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($expedientes as $item)
                                            <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                    {{$item->numeracion}}
                                                </th>
                                                <td class="px-6 py-4">
                                                    {{$item->tipo}} -
                                                    {{$item->tipo_documento}}
                                                </td>
                                                <td class="px-6 py-4">
                                                    {{date("d/m/Y", strtotime($item->created_at))}} - {{date("H:i", strtotime($item->created_at))}}
                                                </td>
                                                <td class="px-6 py-4">
                                                    {{$item->asunto}}
                                                </td>
                                                <td class="px-6 py-4">
                                                    @if ($item->expedientable instanceof App\Models\Secretaria)
                                                    {{$item->expedientable->user->name}}
                                                    @else
                                                    {{$item->expedientable->razon_social}}
                                                    @endif
                                                </td>
                                                <td class="px-6 py-4">
                                                    @foreach ($item->documentos as $documento)
                                                    <div class="inline-block mr-2">
                                                        <a target="_blank" href="{{route('secretaria.expediente.ver-pdf',['name'=>$documento->nombre_path])}}">
                                                            <svg class="w-[20px] h-[20px] text-blue-600 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 14">
                                                                <g stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                                                                    <path d="M10 10a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" />
                                                                    <path d="M10 13c4.97 0 9-2.686 9-6s-4.03-6-9-6-9 2.686-9 6 4.03 6 9 6Z" />
                                                                </g>
                                                            </svg>
                                                        </a>
                                                    </div>
                                                    @endforeach
                                                </td>
                                                <td class="px-6 py-4">
                                                    @foreach ($item->proveidos as $proveido)
                                                    Pase a: {{$proveido->pase}}
                                                    Para: {{$proveido->para}}
                                                    Fecha y hora: {{date("d/m/Y", strtotime($proveido->fecha))}} - {{date("H:i", strtotime($proveido->fecha))}}
                                                    <br>
                                                    <br>
                                                    @endforeach
                                                </td>
                                                <td class="px-6 py-4">
                                                    @switch($item->estado)
                                                    @case('por definir')
                                                    <span class="bg-gray-100 text-gray-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-gray-300">{{$item->estado}}</span>
                                                    @break
                                                    @case('atendido')
                                                    <span class="bg-green-100 text-green-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">{{$item->estado}}</span>
                                                    @break
                                                    @case('derivado')
                                                    <span class="bg-yellow-100 text-yellow-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-yellow-900 dark:text-yellow-300">{{$item->estado}}</span>
                                                    @break
                                                    @case('rechazado')
                                                    <span class="bg-red-100 text-red-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-yellow-900 dark:text-yellow-300">{{$item->estado}}</span>
                                                    @break
                                                    @endswitch
                                                </td>
                                                <td class="px-6 py-4">
                                                    <button id="actionsDropdownButtonExpediente" data-dropdown-toggle="actionsDropdownExpediente-{{$item->id}}" class="flex items-center justify-center w-full px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg md:w-auto focus:outline-none hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700" type="button">
                                                        <svg class="-ml-1 mr-1.5 w-5 h-5" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                                            <path clip-rule="evenodd" fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" />
                                                        </svg>
                                                        Acciones
                                                    </button>
                                                    <div id="actionsDropdownExpediente-{{$item->id}}" class="z-10 hidden bg-white divide-y divide-gray-100 rounded shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
                                                        <ul class="py-1 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="actionsDropdownButton">

                                                            @if ($item->estado != 'atendido')
                                                            <li>
                                                                <a href="{{route('secretaria.expediente.atender',['expediente'=>$item])}}" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Atender</a>
                                                            </li>

                                                            @if ($item->tipo == 'externo')
                                                            <li>
                                                                <a role="button" id="derivarExpedienteModalButton" data-modal-toggle="derivarExpedienteModal-{{$item->id}}" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Realizar proveído</a>
                                                            </li>
                                                            @endif

                                                            @else
                                                            <li>
                                                                <a href="{{route('secretaria.expediente.atender',['expediente'=>$item])}}" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Ver historial</a>
                                                            </li>
                                                            @endif

                                                            <!----El cambio de estado solo lo realiza la persona a cargo de secretaría----->
                                                            @if (Auth::user()->secretaria->area_id == 4 && $item->estado != 'atendido')
                                                            <li>
                                                                <a role="button" id="estadoModalButton" data-modal-toggle="estadoModal-{{$item->id}}" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Cambiar estado</a>
                                                            </li>
                                                            @endif

                                                            @if ($item->estado == 'proveido' && $item->tipo == 'interno' && Auth::user()->secretaria->area_id != 4)
                                                            <li>
                                                                <form action="{{route('secretaria.expediente.achivarExpediente',['expediente'=>$item])}}" method="post">
                                                                    @csrf
                                                                    <button type="submit" class="block px-4 py-2 hover:bg-gray-100">Archivar</button>
                                                                </form>
                                                            </li>
                                                            @endif


                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>

                                            <!----Modal para cambiar estado--->
                                            <div id="estadoModal-{{$item->id}}" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                                <div class="relative w-full max-w-md max-h-full">
                                                    <!-- Modal content -->
                                                    <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
                                                        <!-- Modal header -->
                                                        <div class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 dark:border-gray-600">
                                                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                                                Cambiar estado del expediente
                                                            </h3>
                                                            <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="estadoModal-{{$item->id}}">
                                                                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                                                </svg>
                                                                <span class="sr-only">Close modal</span>
                                                            </button>
                                                        </div>
                                                        <!-- Modal body -->
                                                        <form action="{{route('secretaria.expediente.cambiarEstado',['id'=>$item->id])}}" method="post">
                                                            @csrf
                                                            @method('PATCH')
                                                            <div class="grid gap-4 mb-4 sm:grid-cols-2">

                                                                <div>
                                                                    <label for="estado" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Estado:</label>
                                                                    <select id="estado" name="estado" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                                                        @foreach(['por definir','derivado','atendido','rechazado'] as $estado)
                                                                        <option value="{{ $estado }}" {{ $item->estado == $estado ? 'selected' : '' }}>
                                                                            {{ ucfirst($estado) }}
                                                                        </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>

                                                            </div>
                                                            <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                                                Guardar
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>

                                            <!----Modal para reealizar proveído--->
                                            <div id="derivarExpedienteModal-{{$item->id}}" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                                <div class="relative w-full max-w-md max-h-full">
                                                    <!-- Modal content -->
                                                    <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
                                                        <!-- Modal header -->
                                                        <div class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 dark:border-gray-600">
                                                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                                                Realizar Proveido
                                                            </h3>
                                                            <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="derivarExpedienteModal-{{$item->id}}">
                                                                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                                                </svg>
                                                                <span class="sr-only">Close modal</span>
                                                            </button>
                                                        </div>
                                                        <!--p class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Crea </p--->
                                                        <!-- Modal body -->
                                                        <form action="{{route('secretaria.expediente.derivarArea',['id'=>$item->id])}}" method="post">
                                                            @csrf
                                                            @method('PATCH')
                                                            <div class="grid gap-4 mb-4 sm:grid-cols-2">

                                                                <div>
                                                                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Areá actual del expediente: {{$item->area->nombre}}</label>
                                                                </div>

                                                                <div class="col-span-2">
                                                                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pase a:</label>
                                                                    <select id="area_id" name="area_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                                                        @foreach ($areas as $area)
                                                                        <option value="{{$area->id}}" @selected($area->id == $item->area_id)>{{$area->nombre}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                    <!---input type="text" name="pase" id="pase" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" required--->
                                                                </div>

                                                                <div class="col-span-2">
                                                                    <label for="para" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Para:</label>
                                                                    <input type="text" name="para" id="para" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" required>
                                                                </div>

                                                            </div>
                                                            <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                                                                Crear proveído
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>

                                            @endforeach

                                        </tbody>
                                    </table>
                                </div>

                                <!----Paginación--->
                                @if ($expedientes->hasPages())
                                <div class="px-6 py-4">
                                    {{ $expedientes->links() }}
                                </div>
                                @endif

                                @endif


                            </div>
                            <div class="hidden p-4 bg-white rounded-lg md:p-8 dark:bg-gray-800" id="enviados" role="tabpanel" aria-labelledby="enviados-tab">

                                <!---Tabla--->
                                @if ($expedientesEnviados->isEmpty())
                                <div class="px-6 py-4">
                                    <p class="text-center text-base text-gray-900 dark:text-white">No hay registros</p>
                                </div>
                                @else
                                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                            <tr>
                                                <th scope="col" class="px-6 py-3">
                                                    N° expediente
                                                </th>
                                                <th scope="col" class="px-6 py-3">
                                                    Asunto
                                                </th>
                                                <th scope="col" class="px-6 py-3">
                                                    Documento
                                                </th>
                                                <th scope="col" class="px-6 py-3">
                                                    Estado
                                                </th>
                                                <th scope="col" class="px-6 py-3">
                                                    Ver historial
                                                </th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($expedientesEnviados as $item)
                                            <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                                                <th scope="row" class="px-6 py-4">
                                                    {{$item->numeracion}}
                                                </th>
                                                <td class="px-6 py-4">
                                                    {{$item->asunto}}
                                                </td>
                                                <td class="px-6 py-4">
                                                    @foreach ($item->documentos as $documento)
                                                    <div class="inline-block mr-2">
                                                        <a target="_blank" href="{{route('secretaria.expediente.ver-pdf',['name'=>$documento->nombre_path])}}">
                                                            <svg class="w-[20px] h-[20px] text-blue-600 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 14">
                                                                <g stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                                                                    <path d="M10 10a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" />
                                                                    <path d="M10 13c4.97 0 9-2.686 9-6s-4.03-6-9-6-9 2.686-9 6 4.03 6 9 6Z" />
                                                                </g>
                                                            </svg>
                                                        </a>
                                                    </div>
                                                    @endforeach
                                                </td>
                                                <td class="px-6 py-4">
                                                    @switch($item->estado)
                                                    @case('por definir')
                                                    <span class="bg-gray-100 text-gray-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-gray-300">{{$item->estado}}</span>
                                                    @break
                                                    @case('atendido')
                                                    <span class="bg-green-100 text-green-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">{{$item->estado}}</span>
                                                    @break
                                                    @case('derivado')
                                                    <span class="bg-yellow-100 text-yellow-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-yellow-900 dark:text-yellow-300">{{$item->estado}}</span>
                                                    @break
                                                    @case('rechazado')
                                                    <span class="bg-red-100 text-red-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-yellow-900 dark:text-yellow-300">{{$item->estado}}</span>
                                                    @break
                                                    @endswitch
                                                </td>
                                                <td class="px-6 py-4">
                                                    <button id="readExpedienteButton" data-modal-target="readExpedienteModal-{{$item->id}}" data-modal-toggle="readExpedienteModal-{{$item->id}}" class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center" type="button">
                                                        <svg class="w-6 h-6 text-white dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 16 20">
                                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 17V2a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H3a2 2 0 0 0-2 2Zm0 0a2 2 0 0 0 2 2h12M5 15V1m8 18v-4" />
                                                        </svg>
                                                    </button>
                                                </td>
                                            </tr>


                                            <div id="readExpedienteModal-{{$item->id}}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
                                                <div class="relative p-4 w-full max-w-xl h-full md:h-auto">
                                                    <!-- Modal content -->
                                                    <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
                                                        <!-- Modal header -->
                                                        <div class="flex justify-between mb-4 rounded-t sm:mb-5">
                                                            <div class="text-lg text-gray-900 md:text-xl dark:text-white">
                                                                <h3 class="font-semibold ">
                                                                    Expediente N° {{$item->numeracion}}
                                                                </h3>
                                                                <p class="font-bold text-base">
                                                                    Enviado a : {{$item->area->nombre}}
                                                                </p>
                                                            </div>
                                                            <div>
                                                                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 inline-flex dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="readExpedienteModal-{{$item->id}}">
                                                                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                                                    </svg>
                                                                    <span class="sr-only">Close modal</span>
                                                                </button>
                                                            </div>
                                                        </div>
                                                        <dl>
                                                            @if ($item->historiales->isEmpty())

                                                            <dt class="mb-2 font-semibold leading-none text-gray-900 dark:text-white">No hay un historial</dt>

                                                            @else

                                                            <dt class="mb-2 font-semibold leading-none text-gray-900 dark:text-white">Historial</dt>
                                                            @foreach ($item->historiales as $h)
                                                            <dd class="mb-4 font-light text-gray-500 sm:mb-5 dark:text-gray-400">
                                                                Fecha y hora: {{date("d/m/Y", strtotime($h->fecha_hora))}} - {{date("H:i", strtotime($h->fecha_hora))}}
                                                                <br>
                                                                {{$h->descripcion}}
                                                                <br>
                                                                Documentos:
                                                                @if ($h->documento_adjunto)
                                                                <a href="#" target="_blank" class="font-medium text-blue-600 underline dark:text-blue-500 hover:no-underline">
                                                                    {{$h->documento_adjunto}}
                                                                </a>
                                                                @else
                                                                No hay documento
                                                                @endif
                                                                <br>
                                                                Autor: {{$h->user->name}}
                                                            </dd>
                                                            @endforeach

                                                            @endif


                                                        </dl>

                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach

                                        </tbody>
                                    </table>
                                </div>

                                @endif


                            </div>

                        </div>
                    </div>

                </div>
            </section>


        </div>
    </div>



</x-app-layout>
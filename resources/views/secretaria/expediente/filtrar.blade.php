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
                        <a href="{{route('secretaria.expedientes.index')}}" class="ml-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ml-2 dark:text-gray-400 dark:hover:text-white">
                            Expedientes
                        </a>
                    </div>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <svg class="w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4" />
                        </svg>
                        <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2 dark:text-gray-400">Crear reportes</span>
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
                            Crear reportes por fecha
                        </h2>

                        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                            En este módulo podrá crear reportes de los expedientes.
                            Llené ambas fechas del formulario y luego de clic en Buscar para poder obtener los registros dentro de ese rango.
                        </p>

                    </div>

                    <!---div class="w-full lg:w-1/3 lg:text-center">
                        <a href="#" class="mr-3 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                            Crear reportes
                        </a>
                    </div---->

                </header>
            </div>

            <!------Formulario de busqueda----->
            <section class="bg-white sm:rounded-lg shadow">
                <div class="mx-auto max-w-screen-xl">

                    <form action="{{route('secretaria.expediente.filtrarExpedientes')}}" class="p-4 space-y-8 lg:grid md:grid-cols-2 sm:gap-6 lg:space-y-0">

                        <div>
                            <x-input-label for='fecha_inicio' value='Fecha Inicial:' class="text-xs" />
                            <x-text-input class="text-xs mt-2 block w-full" type='date' id="fecha_inicio" name='fecha_inicio' required autocomplete='fecha_inicio' :value="$fecha_inicio ?? ''" />
                            <x-input-error class="mt-2 text-xs" :messages="$errors->get('fecha_inicio')" />
                        </div>

                        <div>
                            <x-input-label for='fecha_fin' value='Fecha Final:' class="text-xs" />
                            <x-text-input class="text-xs mt-2 block w-full" type='date' id="fecha_fin" name='fecha_fin' required autocomplete='fecha_fin' :value="$fecha_fin ?? ''" />
                            <x-input-error class="mt-2 text-xs" :messages="$errors->get('fecha_fin')" />
                        </div>

                        <div class="mt-1 flex items-center">
                            <x-primary-button>Buscar</x-primary-button>
                        </div>

                    </form>

                </div>
            </section>


            <!----Tabla------------------------>
            @if (!isset($fecha_fin) && !isset($fecha_inicio))
            <div class="bg-white shadow-md sm:rounded-lg text-center p-5 ">
                Sin resultados
            </div>
            @else

            @if (count($expedientes))
            <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">

                <div class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-4">
                    <div class="w-full md:w-auto flex flex-col md:flex-row space-y-2 md:space-y-0 items-stretch md:items-center justify-end md:space-x-3 flex-shrink-0">
                        <a target="_blank" href="{{route('secretaria.expediente.downloadExpediente',
                            [
                                'fechainicio' => $fecha_inicio,
                                'fechafin' => $fecha_fin
                                ]
                            )}}" 
                        class="flex items-center justify-center text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 focus:outline-none">
                            <svg class="h-3.5 w-3.5 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M14.707 7.793a1 1 0 0 0-1.414 0L11 10.086V1.5a1 1 0 0 0-2 0v8.586L6.707 7.793a1 1 0 1 0-1.414 1.414l4 4a1 1 0 0 0 1.416 0l4-4a1 1 0 0 0-.002-1.414Z" />
                                <path d="M18 12h-2.55l-2.975 2.975a3.5 3.5 0 0 1-4.95 0L4.55 12H2a2 2 0 0 0-2 2v4a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-4a2 2 0 0 0-2-2Zm-3 5a1 1 0 1 1 0-2 1 1 0 0 1 0 2Z" />
                            </svg>
                            Descargar
                        </a>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-4 py-3">Numeración</th>
                                <th scope="col" class="px-4 py-3">Tipo</th>
                                <th scope="col" class="px-4 py-3">Estado</th>
                                <th scope="col" class="px-4 py-3">Asunto</th>
                                <th scope="col" class="px-4 py-3">Area responsable</th>
                                <th scope="col" class="px-4 py-3">Remitente</th>
                                <th scope="col" class="px-4 py-3">Fecha de envío</th>
                                <th scope="col" class="px-4 py-3">Hora de envío</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($expedientes as $item)
                            <tr class="border-b dark:border-gray-700">
                                <th scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{$item->numeracion}}</th>
                                <td class="px-4 py-3">{{ucfirst($item->tipo)}}</td>
                                <td class="px-4 py-3">{{ucfirst($item->estado)}}</td>
                                <td class="px-4 py-3">{{$item->asunto}}</td>
                                <td class="px-4 py-3">{{$item->area->nombre}}</td>
                                <td class="px-4 py-3">
                                    @if ($item->expedientable instanceof App\Models\Secretaria)
                                    {{$item->expedientable->user->name}}
                                    @else
                                    {{$item->expedientable->razon_social}}
                                    @endif
                                </td>
                                <td class="px-4 py-3">{{date("d/m/Y", strtotime($item->created_at))}}</td>
                                <td class="px-4 py-3">{{date("H:i", strtotime($item->created_at))}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
            @else
            <div class="bg-white shadow-md sm:rounded-lg text-center p-5 ">
                Sin resultados
            </div>
            @endif

            @endif





        </div>
    </div>



</x-app-layout>
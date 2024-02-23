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
                        <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2 dark:text-gray-400">Jurado calificador</span>
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
                            Lista de practicantes finales
                        </h2>

                        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                            Luego de que los practicantes hayan terminado sus prácticas, deberá asignarles un jurado evaluador.
                        </p>
                    </div>

                </header>
            </div>


            @if ($practicantes->count())
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <caption class="p-5 text-lg font-semibold text-left rtl:text-right text-gray-900 bg-white dark:text-white dark:bg-gray-800">
                        Practicantes aprobados
                    </caption>
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Nombre del practicante
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Informe final
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Jurados
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Opciones
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($practicantes as $item)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{$item->razon_social}}
                            </th>
                            <td class="px-6 py-4">
                                <a target="_blank" href="{{route('director.juradoCalificador.ver-pdf',['name' => $item->path_informe_final])}}">{{$item->path_informe_final}}</a>
                            </td>
                            <td class="px-6 py-4">
                                <ul>
                                    <li>Presidente: {{$item->Presidente}}</li>
                                    <li>Secretario: {{$item->Secretario}}</li>
                                    <li>Vocal: {{$item->Vocal}}</li>
                                    <li>Accesitario: {{$item->Accesitario}}</li>
                                </ul>
                            </td>
                            <td class="px-6 py-4">
                                <a href="{{route('director.juradoCalificador.create',['practica' => $item->id])}}">Asignar jurado evaluador</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else
            <p class="mx-auto">Sin resultados</p>
            @endif


        </div>
    </div>



</x-app-layout>
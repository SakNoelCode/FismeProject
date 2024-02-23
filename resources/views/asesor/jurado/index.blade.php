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

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <header>
                    <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                        {{ __('Jurado Calificador') }}
                    </h2>

                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                        {{ __("En esta vista, se mostrarán aquellos practicantes que deberá evaluar para su sustentación final.") }}
                    </p>
                </header>
            </div>

            <section class="bg-gray-50 dark:bg-gray-900">
                <div class="mx-auto max-w-screen-xl">

                    @if ($practicas->count())
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        Practicante
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Documentos
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Jurados
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Acciones
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($practicas as $item)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{$item->razon_social}}
                                    </th>
                                    <td class="px-6 py-4">
                                        <ul>
                                            <li>Informe final: <a target="_blank" href="{{route('asesor.jurado.ver-pdf-informe',['name'=>$item->path_informe_final])}}" class="font-medium text-blue-600 underline dark:text-blue-500 hover:no-underline">Ver</a></li>
                                            <li>Acta de sustentación: <a target="_blank" href="{{route('asesor.jurado.ver-pdf',['name'=>$item->path_acta_sustentacion])}}" class="font-medium text-blue-600 underline dark:text-blue-500 hover:no-underline">Ver</a></li>
                                        </ul>
                                        
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
                                        <div class="inline-flex rounded-md shadow-sm" role="group">
                                            <button data-modal-target="asignar-fecha-modal-{{$item->id}}" data-modal-toggle="asignar-fecha-modal-{{$item->id}}" type="button" class="px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-s-lg hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-blue-500 dark:focus:text-white">
                                                Asignar horario
                                            </button>
                                            <a target="_blank" role="button" href="{{route('asesor.comision.generateActaSustentacionView',['practicante'=>$item])}}" class=" px-4 py-2 text-sm font-medium text-gray-900 bg-white border-t border-b border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-blue-500 dark:focus:text-white">
                                                Generar documento
                                            </a>
                                            <button data-modal-target="subir-documento-modal-{{$item->id}}" data-modal-toggle="subir-documento-modal-{{$item->id}}" type="button" class="px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-e-lg hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-blue-500 dark:focus:text-white">
                                                Subir documento
                                            </button>
                                        </div>
                                    </td>
                                </tr>

                                <!-- Modal para la fecha -->
                                <div id="asignar-fecha-modal-{{$item->id}}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                    <div class="relative p-4 w-full max-w-md max-h-full">
                                        <!-- Modal content -->
                                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                            <!-- Modal header -->
                                            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                                    Asignar fecha y hora de sustentación
                                                </h3>
                                                <button type="button" class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="asignar-fecha-modal-{{$item->id}}">
                                                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                                    </svg>
                                                    <span class="sr-only">Close modal</span>
                                                </button>
                                            </div>
                                            <!-- Modal body -->
                                            <div class="p-4 md:p-5">
                                                <form action="{{route('asesor.jurado.update-fecha-sustentacion-final',['id'=>$item->id])}}" method="post">
                                                    <p class="text-sm text-gray-900">Fecha y hora:
                                                        @if ($item->fecha_sustentacion_final)
                                                        {{date("d/m/Y", strtotime($item->fecha_sustentacion_final))}} - {{date("H:i", strtotime($item->fecha_sustentacion_final))}}
                                                        @else
                                                        Sin asignar
                                                        @endif
                                                        
                                                    </p>
                                                    <br>
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
                                </div>

                                <!-- Modal para subir el documento -->
                                <div id="subir-documento-modal-{{$item->id}}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                    <div class="relative p-4 w-full max-w-md max-h-full">
                                        <!-- Modal content -->
                                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                            <!-- Modal header -->
                                            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                                    Subir acta de sustentación
                                                </h3>
                                                <button type="button" class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="subir-documento-modal-{{$item->id}}">
                                                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                                    </svg>
                                                    <span class="sr-only">Close modal</span>
                                                </button>
                                            </div>
                                            <!-- Modal body -->
                                            <div class="p-4 md:p-5">
                                                <form action="{{route('asesor.jurado.store-acta-sustentacion',['practica' => $item])}}" method="post" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="grid gap-4 mb-4 grid-cols-2">
                                                        <div class="col-span-2">
                                                            <label for="path_documento" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Acta de sustentacion firmada:</label>
                                                            <input accept=".pdf" type="file" name="path_documento" id="path_documento" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required="">
                                                        </div>
                                                    </div>
                                                    <button type="submit" class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                                        Guardar
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    @else
                    <div class="px-6 py-4">
                        <p class="text-center text-base text-gray-900 dark:text-white">Sin resultados</p>
                    </div>
                    @endif

                </div>
            </section>


        </div>
    </div>

</x-app-layout>
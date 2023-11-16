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
                        <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2 dark:text-gray-400">Comisión</span>
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
                            Comisión para la revisión y aprobación de prácticas preprofesionales
                        </h2>

                        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                            Integrado por 3 docentes de la facultad.
                        </p>
                    </div>


                    <div class="w-full lg:w-1/3">
                        <a href="{{route('director.comision.create')}}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                            Asignar comisión
                        </a>
                    </div>

                </header>
            </div>

            <!---Cuerpo--->
            <section class="bg-white dark:bg-gray-900">
                <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-8 lg:px-6 ">
                    <div class="mx-auto max-w-screen-sm text-center mb-8 lg:mb-8">
                        <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-gray-900 dark:text-white">Comisión actual</h2>
                        <p class="font-light text-gray-500 lg:mb-4 sm:text-xl dark:text-gray-400"> @if ($comision!=null) Del {{$comision->fecha_inicio}} hasta {{$comision->fecha_fin}} @endif</p>
                    </div>
                    @if ($comision==null)
                    <p class="mt-1 text-base text-gray-600 dark:text-gray-400">
                        Aún no se asigna una comisión.
                    </p>
                    @else
                    <div class="grid gap-8 mb-6 lg:mb-16 md:grid-cols-3">
                        @foreach ($comision->asesores as $item)
                        <div class="items-center bg-gray-50 rounded-lg shadow sm:flex dark:bg-gray-800 dark:border-gray-700">

                            <div class="p-5">
                                <h3 class="text-xl font-bold tracking-tight text-gray-900 dark:text-white">
                                    <a href="#">{{$item->user->name}}</a>
                                </h3>
                                <span class="text-gray-500 dark:text-gray-400">{{$item->especialidad}}</span>

                            </div>
                        </div>
                        @endforeach

                    </div>
                    @endif

                </div>
            </section>

        </div>
    </div>



</x-app-layout>
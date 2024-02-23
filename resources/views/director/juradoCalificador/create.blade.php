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
                        <a href="{{route('director.juradoCalificador.index')}}" class="ml-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ml-2 dark:text-gray-400 dark:hover:text-white">Jurado calificador</a>
                    </div>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <svg class="w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4" />
                        </svg>
                        <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2 dark:text-gray-400">Asignar jurado evaluador</span>
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
                            Asigne un jurado calificador
                        </h2>

                        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                            Asigne un presidente, un secretarío, un vocal y un accesitario para la evalucación final de la práctica.
                        </p>
                    </div>

                </header>
            </div>


            <!---Cuerpo--->
            <div class="p-4 sm:px-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">

                    <form action="{{route('director.juradoCalificador.update',['practica'=>$practica])}}" class="space-y-6" method="post">
                        @csrf

                        <div>
                            <x-input-label for="presidente" :value="__('Presidente (*):')" class="text-xs" />
                            <select name="presidente" id="presidente" class="text-xs mt-1 block w-full border-gray-300 focus:border-indigo-500 rounded-md shadow-sm" required>
                                <option value="" selected disabled>Seleccione:</option>
                                @foreach ($asesores as $item)
                                @if ($practica->presidente_id && $item->id == $practica->presidente_id)
                                <option selected value="{{ $item->id }}" @selected(old('presidente')==$item->id)>{{ ucfirst($item->user->name) }}</option>
                                @else
                                <option value="{{ $item->id }}" @selected(old('presidente')==$item->id)>{{ ucfirst($item->user->name) }}</option>
                                @endif
                                @endforeach
                            </select>
                            <x-input-error class="mt-2 text-xs" :messages="$errors->get('presidente')" />
                        </div>

                        <div>
                            <x-input-label for="secretario" :value="__('Secretarío (*):')" class="text-xs" />
                            <select name="secretario" id="secretario" class="text-xs mt-1 block w-full border-gray-300 focus:border-indigo-500 rounded-md shadow-sm" required>
                                <option value="" selected disabled>Seleccione:</option>
                                @foreach ($asesores as $item)
                                @if ($practica->secretario_id && $item->id == $practica->secretario_id)
                                <option selected value="{{ $item->id }}" @selected(old('secretario')==$item->id)>{{ ucfirst($item->user->name) }}</option>
                                @else
                                <option value="{{ $item->id }}" @selected(old('secretario')==$item->id)>{{ ucfirst($item->user->name) }}</option>
                                @endif
                                @endforeach
                            </select>
                            <x-input-error class="mt-2 text-xs" :messages="$errors->get('secretario')" />
                        </div>

                        <div>
                            <x-input-label for="vocal" :value="__('Vocal (*):')" class="text-xs" />
                            <select name="vocal" id="vocal" class="text-xs mt-1 block w-full border-gray-300 focus:border-indigo-500 rounded-md shadow-sm" required>
                                <option value="" selected disabled>Seleccione:</option>
                                @foreach ($asesores as $item)
                                @if ($practica->vocal_id && $item->id == $practica->vocal_id)
                                <option selected value="{{ $item->id }}" @selected(old('vocal')==$item->id)>{{ ucfirst($item->user->name) }}</option>
                                @else
                                <option value="{{ $item->id }}" @selected(old('vocal')==$item->id)>{{ ucfirst($item->user->name) }}</option>
                                @endif
                                @endforeach
                            </select>
                            <x-input-error class="mt-2 text-xs" :messages="$errors->get('vocal')" />
                        </div>

                        <div>
                            <x-input-label for="accesitario" :value="__('Accesitario (*):')" class="text-xs" />
                            <select name="accesitario" id="accesitario" class="text-xs mt-1 block w-full border-gray-300 focus:border-indigo-500 rounded-md shadow-sm" required>
                                <option value="" selected disabled>Seleccione:</option>
                                @foreach ($asesores as $item)
                                @if ($practica->accesitario_id && $item->id == $practica->accesitario_id)
                                <option selected value="{{ $item->id }}" @selected(old('accesitario')==$item->id)>{{ ucfirst($item->user->name) }}</option>
                                @else
                                <option value="{{ $item->id }}" @selected(old('accesitario')==$item->id)>{{ ucfirst($item->user->name) }}</option>
                                @endif
                                @endforeach
                            </select>
                            <x-input-error class="mt-2 text-xs" :messages="$errors->get('accesitario')" />
                        </div>



                        <div class="flex items-center gap-4">
                            <button type="submit" class="px-3 py-2 text-xs font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300">
                                Guardar
                            </button>
                        </div>
                    </form>

                </div>
            </div>





        </div>
    </div>



</x-app-layout>
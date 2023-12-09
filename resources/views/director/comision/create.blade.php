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
                        <a href="{{route('director.comision.index')}}" class="ml-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ml-2 dark:text-gray-400 dark:hover:text-white">Comisión</a>
                    </div>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <svg class="w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4" />
                        </svg>
                        <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2 dark:text-gray-400">Crear Comisión</span>
                    </div>
                </li>
            </ol>
        </nav>
    </x-slot>

    @include('include.alert')


    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">


            <!---Cuerpo--->
            <div class="p-4 sm:px-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">

                    <form action="{{route('director.comision.update')}}" class="space-y-6" method="post">
                        @csrf
                        <div>
                            <x-input-label for="fecha_inicio" :value="__('Fecha de Inicio (*):')" class="text-xs" />
                            <x-text-input autofocus required id="fecha_inicio" name="fecha_inicio" type="date" class="mt-1 block w-full text-xs" :value="old('fecha_inicio')" />
                            <x-input-error class="mt-2 text-xs" :messages="$errors->get('fecha_inicio')" />
                        </div>

                        <div>
                            <x-input-label for="fecha_fin" :value="__('Fecha de fin (*):')" class="text-xs" />
                            <x-text-input required id="fecha_fin" name="fecha_fin" type="date" class="mt-1 block w-full text-xs" :value="old('fecha_fin')" />
                            <x-input-error class="mt-2 text-xs" :messages="$errors->get('fecha_fin')" />
                        </div>

                        <div>
                            <x-input-label for="asesores" :value="__('Escoja 3 docentes para que formen parte de la comisión (*):')" class="text-xs mb-3" />
                            @foreach ($asesores as $asesor)
                            <div class="flex items-start mb-2">
                                <div class="flex items-center h-5">
                                    <input 
                                    id="{{$asesor->id}}" 
                                    value="{{$asesor->user->name}}" 
                                    name="asesores[]" 
                                    type="checkbox"
                                    @if(is_array(old('asesores')) && in_array($asesor->id, old('asesores'))) checked @endif 
                                    class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800">
                                </div>
                                <label for="{{$asesor->id}}" class="ms-2 text-xs font-medium text-gray-900 dark:text-gray-300">{{$asesor->user->name}}</label>
                            </div>
                            @endforeach
                            <x-input-error class="mt-2 text-xs" :messages="$errors->get('asesores')" />
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
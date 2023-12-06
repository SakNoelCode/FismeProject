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
                        <a href="{{route('proyectos.index')}}" class="ml-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ml-2 dark:text-gray-400 dark:hover:text-white">Proyectos de tesis</a>
                    </div>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <svg class="w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4" />
                        </svg>
                        <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2 dark:text-gray-400">Asignar jurado</span>
                    </div>
                </li>
            </ol>
        </nav>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-2xl">

                    <section>
                        <header>
                            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                Asignar un jurado el proyecto
                            </h2>

                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                El jurado son docentes que evaluarán el proyecto.
                            </p>
                        </header>

                        <form method="post" action="{{route('secretaria.proyecto.saveAsignarJurado',['proyecto'=>$proyecto])}}" class="mt-6 space-y-6">
                            @csrf

                            <div>
                                <x-input-label for="presidente" :value="__('Presidente del jurado:')" />
                                <select name="presidente" id="presidente" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>

                                    @if (!$proyecto->juradotesi_id)
                                    <option value="" disabled>Seleccione:</option>
                                    @endif

                                    @foreach ($docentes as $docente)
                                    <option value="{{ $docente->user->name }}" {{ ($proyecto->juradotesi_id && $proyecto->juradotesis->presidente == $docente->user->name) || old('presidente') == $docente->user->name ? 'selected' : '' }}>
                                        {{ ucfirst($docente->user->name) }}
                                    </option>
                                    @endforeach

                                </select>
                                <x-input-error class="mt-2" :messages="$errors->get('presidente')" />
                            </div>

                            <div>
                                <x-input-label for="secretario" :value="__('Secretario del jurado:')" />
                                <select name="secretario" id="secretario" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>


                                    @if (!$proyecto->juradotesi_id)
                                    <option value="" disabled>Seleccione:</option>
                                    @endif

                                    @foreach ($docentes as $docente)
                                    <option value="{{ $docente->user->name }}" {{ ($proyecto->juradotesi_id && $proyecto->juradotesis->secretario == $docente->user->name) || old('secretario') == $docente->user->name ? 'selected' : '' }}>
                                        {{ ucfirst($docente->user->name) }}
                                    </option>
                                    @endforeach


                                </select>
                                <x-input-error class="mt-2" :messages="$errors->get('secretario')" />
                            </div>

                            <div>
                                <x-input-label for="vocal" :value="__('Vocal del jurado')" />
                                <select name="vocal" id="vocal" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                                    @if (!$proyecto->juradotesi_id)
                                    <option value="" disabled>Seleccione:</option>
                                    @endif

                                    @foreach ($docentes as $docente)
                                    <option value="{{ $docente->user->name }}" {{ ($proyecto->juradotesi_id && $proyecto->juradotesis->vocal == $docente->user->name) || old('vocal') == $docente->user->name ? 'selected' : '' }}>
                                        {{ ucfirst($docente->user->name) }}
                                    </option>
                                    @endforeach
                                </select>
                                <x-input-error class="mt-2" :messages="$errors->get('vocal')" />
                            </div>

                            <div>
                                <x-input-label for="accesitario" :value="__('Accesitario')" />
                                <select name="accesitario" id="accesitario" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                                    @if (!$proyecto->juradotesi_id)
                                    <option value="" disabled>Seleccione:</option>
                                    @endif

                                    @foreach ($docentes as $docente)
                                    <option value="{{ $docente->user->name }}" {{ ($proyecto->juradotesi_id && $proyecto->juradotesis->accesitario == $docente->user->name) || old('accesitario') == $docente->user->name ? 'selected' : '' }}>
                                        {{ ucfirst($docente->user->name) }}
                                    </option>
                                    @endforeach
                                </select>
                                <x-input-error class="mt-2" :messages="$errors->get('accesitario')" />
                            </div>

                            <div class="flex items-center gap-4">
                                <x-primary-button>{{ __('Save') }}</x-primary-button>
                            </div>
                        </form>
                    </section>

                </div>
            </div>


        </div>
    </div>

</x-app-layout>
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
                        <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2 dark:text-gray-400">Crear nuevo proyecto de tesis</span>
                    </div>
                </li>
            </ol>
        </nav>
    </x-slot>

    <section class="bg-white dark:bg-gray-900">
        <div class="py-8 px-4 mx-auto max-w-2xl lg:py-10">

            <div class="p-2 sm:p-4 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <header>
                    <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                        {{ __('Nota:') }}
                    </h2>

                    <p class="my-1 text-sm text-gray-600 dark:text-gray-400">
                        {{ __("Para que el proyecto pueda ser creado, el tesista ya debe haber comprado su carpeta de Tesis y
                            debe presentar los siguientes formatos:") }}
                    <ul class="text-sm space-y-1 text-gray-500 list-disc list-inside dark:text-gray-400">
                        <li>
                            Solicitud dirigida al decano de la facultad (Anexo 3A)
                        </li>
                        <li>
                            Proyecto de tesis triplicado y anillado, con la carátula (Anexo 3B) y estructura (Anexo 3C)
                        </li>
                        <li>
                            Compromiso de asesoramiento de tesis (Anexo 3D)
                        </li>
                    </ul>
                    </p>

                </header>
            </div>

            <h2 class="my-4 text-xl font-bold text-gray-900 dark:text-white">Crear nuevo proyecto de tesis</h2>

            <form action="{{route('proyectos.store')}}" method="post">
                @csrf

                @include('secretaria.include.errors')

                <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                    <div class="sm:col-span-2">
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nombre del proyecto*:</label>
                        <input type="text" name="name" id="name" value="{{old('name')}}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required="">
                    </div>
                    <div>
                        <label for="tesista_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tesista*:</label>
                        <select id="tesista_id" name="tesista_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            <option selected disabled>Seleccione:</option>
                            @foreach ($tesistas as $item)
                            <option value="{{$item->id}}" {{old('tesista_id') == $item->id ? 'selected' : ''}}>{{$item->user->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="asesor_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Asesor*:</label>
                        <select id="asesor_id" name="asesor_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            <option selected disabled>Seleccione:</option>
                            @foreach ($asesores as $item)
                            <option value="{{$item->id}}" {{old('asesor_id') == $item->id ? 'selected' : ''}}>{{$item->user->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="sm:col-span-2">
                        <label for="empresa_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Empresa*:</label>
                        <select id="empresa_id" name="empresa_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            <option selected disabled>Seleccione:</option>
                            @foreach ($empresas as $item)
                            <option value="{{$item->id}}" {{old('empresa_id') == $item->id ? 'selected' : ''}}>{{$item->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="sm:col-span-2">
                        <label for="descripcion" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Descripción:</label>
                        <textarea id="descripcion" name="descripcion" style="resize: none;" rows="8" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Alguna descripción del proyecto aquí">{{old('descripcion')}}</textarea>
                    </div>
                </div>
                <button type="submit" class="inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 rounded-lg mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                    Guardar registro
                </button>
            </form>
        </div>
    </section>



</x-app-layout>
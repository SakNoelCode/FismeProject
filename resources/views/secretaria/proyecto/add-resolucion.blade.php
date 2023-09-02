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
                        <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2 dark:text-gray-400">Agregar nueva resolución</span>
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
                        {{ __('Notas:') }}
                    </h2>
                    <ul class="text-sm space-y-1 text-gray-500 list-disc list-inside dark:text-gray-400">
                        <li>
                            Al crear una resolución, de manera automática cambiará el estado del proyecto
                        </li>
                        <li>
                            Los campos con (*) son obligatorios
                        </li>
                        <li>
                            Deberá subir la resolución escaneada en PDF
                        </li>
                        <li>
                            La descripción es opcional, sin embargo se recomienda añadir:
                        </li>
                        <li>
                            Los nombres de los miembros del jurado si la resolución es de tipo 'Jurado evaluador'
                        </li>
                        <li>
                            Aprobado o desaprobado si la resolución es de tipo 'Evaluación del proyecto de tesis'
                        </li>
                        <li>
                            Caducado si la resolución es de tipo 'Caducidad del proyecto de tesis'
                        </li>
                    </ul>


                </header>
            </div>

            <h2 class="my-4 text-xl font-bold text-gray-900 dark:text-white">Crear nueva resolución</h2>

            <form action="{{route('proyecto.storeAddResolucion',['proyecto'=>$proyecto])}}" method="post" enctype="multipart/form-data">
                @csrf

                @include('include.errors')

                <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                    <div class="sm:col-span-2">
                        <label for="tipo" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tipo de resolución: *</label>
                        <select required id="tipo" name="tipo" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            <option value="" selected disabled>Seleccione:</option>
                            <option value="1">Resolución para el jurado evaluador</option>
                            <option value="2">Resolución de la evaluación del proyecto de tesis</option>
                            <option value="3">Resolución de caducidad del proyecto de tesis</option>
                        </select>
                    </div>
                    <div class="sm:col-span-2">
                        <label for="resolucion_path" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Documento: *</label>
                        <input type="file" accept=".doc,.docx,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document,.pdf" name="resolucion_path" id="resolucion_path" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required="">
                    </div>
                    <div class="sm:col-span-2">
                        <label for="descripcion" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Descripción:</label>
                        <textarea id="descripcion" name="descripcion" style="resize: none;" rows="8" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Puede escribir aquí los miembros del jurado evaluador o cualquier otra descripción">{{old('descripcion')}}</textarea>
                    </div>
                </div>
                <button type="submit" class="inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 rounded-lg mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                    Guardar registro
                </button>
            </form>
        </div>
    </section>

</x-app-layout>
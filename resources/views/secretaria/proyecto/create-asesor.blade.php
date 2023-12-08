<x-app-layout>
    <x-slot name="header">
        <!-- Breadcrumb -->
        <nav class="flex" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                    <a href="{{ route('dashboard') }}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white">
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
                        <a href="{{ route('proyectos.index') }}" class="ml-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ml-2 dark:text-gray-400 dark:hover:text-white">Proyectos de tesis</a>
                    </div>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <svg class="w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4" />
                        </svg>
                        <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2 dark:text-gray-400">Crear nuevo asesor</span>
                    </div>
                </li>
            </ol>
        </nav>
    </x-slot>

    <!---Contenido--->
    <x-flowbite.form-section-create :action="route('secretaria.save-asesor')">
        <x-slot name='title'>Crear nuevo asesor</x-slot>

        <x-slot name='form'>
            <div class="sm:col-span-2">
                <x-flowbite.form-label for='name' value='Nombres y apellidos' />
                <x-flowbite.form-input name='name' type='text' placeholder='Pepe González' />
            </div>
            <div class="sm:col-span-2">
                <x-flowbite.form-label for='email' value='Correo eléctrónico(institucional)' />
                <x-flowbite.form-input name='email' type='email' placeholder='67345621@untrm.edu.pe' />
            </div>
            <div>
                <x-flowbite.form-label for='especialidad' value='Especialidad' />
                <x-flowbite.form-input name='especialidad' type='text' placeholder='Programación web' />
            </div>
            <div>
                <x-flowbite.form-label for='escuela_id' value='Escuela' />
                <select id="escuela_id" name="escuela_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                    <option selected="">Seleciona</option>
                    @foreach ($escuelas as $item)
                    <option value="{{$item->id}}" {{old('escuela_id') == $item->id ? 'selected' : ''}}>{{$item->name}}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <x-flowbite.form-label for='password' value='Contraseña' />
                <x-flowbite.form-input name='password' type='password' placeholder='' />
            </div>
            <div>
                <x-flowbite.form-label for='password_confirm' value='Confirma contraseña' />
                <x-flowbite.form-input name='password_confirm' type='password' placeholder='' />
            </div>
        </x-slot>

        <x-slot name='actions'>
            <x-flowbite.btn-blue type='submit' value='Crear nuevo registro' />
        </x-slot>
    </x-flowbite.form-section-create>


</x-app-layout>
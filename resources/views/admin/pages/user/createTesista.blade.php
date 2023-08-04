@extends('admin.layouts.app')
@section('title','Usuarios')
@section('styles')
@endsection
@section('header')
<x-flowbite.header value='Módulo para la creación de un nuevo tesista' />

<!-- Breadcrumb -->
<x-flowbite.breadcrumb>
    <x-slot name='li_inicio'>Inicio</x-slot>
    <x-slot name='li_intermedio'>
        <x-flowbite.breadcrumb-item :href="route('usuarios.index')" value='Usuarios' />
    </x-slot>
    <x-slot name='li_final'>Crear nuevo tesista</x-slot>
</x-flowbite.breadcrumb>
@endsection

@section('content')
<x-flowbite.form-section-create :action="route('tesistas.store')">
    <x-slot name='title'>Crear nuevo tesista</x-slot>

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
            <x-flowbite.form-label for='codigo' value='Código' />
            <x-flowbite.form-input name='codigo' type='text' placeholder='45678RT421' />
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
</x-flowbite.form-section-create>
<!---section class="bg-white dark:bg-gray-900">
    <div class="py-6 px-4 mx-auto max-w-2xl lg:py-10">
        
        <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Crear nuevo tesista</h2>

        
        @if ($errors->any())
        <div class="flex p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
            <svg class="flex-shrink-0 inline w-4 h-4 mr-3 mt-[2px]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
            </svg>
            <span class="sr-only">Danger</span>
            <div>
                <span class="font-medium">Tiene los siguiente errores de validación:</span>
                <ul class="mt-1.5 ml-4 list-disc list-inside">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
        @endif

        <form action="{{route('tesistas.store')}}" method="post">
            @csrf
            <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                <div class="sm:col-span-2">
                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nombres y apellidos</label>
                    <input type="text" name="name" id="name" value="{{old('name')}}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Angel Rodríguez" required="">
                </div>
                <div class="sm:col-span-2">
                    <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Correo eléctrónico(institucional)</label>
                    <input type="email" name="email" id="email" value="{{old('email')}}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="67345621@untrm.edu.pe" required="">
                </div>
                <div class="w-full">
                    <label for="codigo" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Código</label>
                    <input type="text" name="codigo" id="codigo" value="{{old('codigo')}}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="45678RT421" required="">
                </div>
                <div>
                    <label for="escuela_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Escuela</label>
                    <select id="escuela_id" name="escuela_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                        <option selected="">Seleciona</option>
                        @foreach ($escuelas as $item)
                        <option value="{{$item->id}}" {{old('escuela_id') == $item->id ? 'selected' : ''}}>{{$item->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Contraseña</label>
                    <input type="password" name="password" id="password" value="{{old('password')}}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="" required="">
                </div>
                <div>
                    <label for="password_confirm" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Confirma contraseña</label>
                    <input type="password" name="password_confirm" id="password_confirm" value="{{old('password_confirm')}}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="" required="">
                </div>
            </div>
            <button type="submit" class="inline-flex items-center mt-4 sm:mt-6 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                Crear nuevo registro
            </button>


        </form>
    </div>
</section--->
@endsection
@section('scripts')
<script>
    $(document).ready(function() {
        let input = $('#codigo');

        input.on('keyup', function() {
            let textoEnMayusculas = input.val().toUpperCase();
            input.val(textoEnMayusculas);
        });
    });
</script>
@endsection
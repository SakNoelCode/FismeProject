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
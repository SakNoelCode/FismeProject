@extends('admin.layouts.app')
@section('title','Editar asesor')
@section('styles')
@endsection
@section('header')
<x-flowbite.header value='Módulo para la modificación de un asesor' />

<!-- Breadcrumb -->
<x-flowbite.breadcrumb>
    <x-slot name='li_inicio'>Inicio</x-slot>
    <x-slot name='li_intermedio'>
        <x-flowbite.breadcrumb-item :href="route('usuarios.index')" value='Usuarios' />
    </x-slot>
    <x-slot name='li_final'>Editar asesor</x-slot>
</x-flowbite.breadcrumb>
@endsection

@section('content')
<x-flowbite.form-section-create :action="route('asesores.update',['asesore'=>$asesor])">

    <x-slot name='title'>Editar asesor</x-slot>

    <x-slot name='form'>
        @method('PATCH')
        <div class="sm:col-span-2">
            <x-flowbite.form-label for='name' value='Nombres y apellidos' />
            <x-flowbite.form-input name='name' type='text' :old='$asesor->name' />
        </div>
        <div class="sm:col-span-2">
            <x-flowbite.form-label for='email' value='Correo eléctrónico(institucional)' />
            <x-flowbite.form-input name='email' type='email' :old='$asesor->email' />
        </div>
        <div>
            <x-flowbite.form-label for='especialidad' value='Especialidad' />
            <x-flowbite.form-input name='especialidad' type='text' :old='$asesor->asesor->especialidad' />
        </div>
        <div>
            <x-flowbite.form-label for='escuela_id' value='Escuela' />
            <select id="escuela_id" name="escuela_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                <option selected="">Seleciona</option>
                @foreach ($escuelas as $item)
                @if ($asesor->asesor->escuela_id == $item->id)
                <option selected value="{{$item->id}}" {{old('escuela_id') == $item->id ? 'selected' : ''}}>{{$item->name}}</option>
                @else
                <option value="{{$item->id}}" {{old('escuela_id') == $item->id ? 'selected' : ''}}>{{$item->name}}</option>
                @endif

                @endforeach
            </select>
        </div>
        <div>
            <x-flowbite.form-label for='password' value='Contraseña' />
            <input type="password" name="password" id="password" class='bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500'>
        </div>
        <div>
            <x-flowbite.form-label for='password_confirm' value='Confirma contraseña' />
            <input type="password" name="password_confirm" id="password_confirm" class='bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500'>
        </div>
    </x-slot>

    <x-slot name='actions'>
        <x-flowbite.btn-blue type='submit' value='Guardar registro' />
    </x-slot>
</x-flowbite.form-section-create>
@endsection
@section('scripts')
<script>

</script>
@endsection
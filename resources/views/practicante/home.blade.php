@extends('layouts.practicas.app')

@section('title','Inicio')

@section('content')
<h3>Bienvenido, siga las instrucciones para que subir la documentación de sus prácticas</h3>

<section class="bg-white dark:bg-gray-900 mt-8">
    @if (Auth::user()->practicante->practica == null)
    <p class="text-lg font-medium text-gray-900 dark:text-white text-center p-10">Aún no se define una práctica.</p>
    @else
    <div class="py-8 px-4 mx-auto max-w-3xl lg:py-8">
        <h2 class="mb-2 text-lg font-extrabold leading-none text-gray-900 md:text-lg">Practica N° {{Auth::user()->practicante->practica->numeracion}}</h2>
        <p class="mb-1 text-base font-semibold leading-none text-gray-900 md:text-base">Por: {{Auth::user()->practicante->razon_social}}</p>
        <p class="mb-4 text-base font-semibold leading-none text-gray-900 md:text-base">Asesor: {{Auth::user()->practicante->asesore->user->name}}</p>
        <dl class="text-xs">
            <dt class="mb-2 font-semibold leading-none text-gray-900">Fecha de sustentación:</dt>
            <dd class="mb-4 font-light text-gray-500 sm:mb-5">{{is_null(Auth::user()->practicante->practica->fecha_sustentacion) ? 'Sin definir' : Auth::user()->practicante->practica->fecha_sustentacion }}</dd>
            <dt class="mb-2 font-semibold leading-none text-gray-900">Etapa</dt>
            <dd class="mb-4 font-light text-gray-500 sm:mb-5">{{Auth::user()->practicante->practica->etapa}}</dd>
            <dt class="mb-2 font-semibold leading-none text-gray-900 dark:text-white">Estado</dt>
            <dd class="mb-4 font-light text-gray-500 sm:mb-5">{{Auth::user()->practicante->practica->estado}}</dd>
        </dl>
    </div>
    @endif

</section>
@endsection
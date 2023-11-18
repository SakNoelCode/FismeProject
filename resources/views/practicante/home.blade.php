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
            <dd class="mb-4 font-light text-gray-500 sm:mb-5">
                @if (is_null(Auth::user()->practicante->practica->fecha_sustentacion))
                Sin definir
                @else
                {{date("d/m/Y", strtotime(Auth::user()->practicante->practica->fecha_sustentacion))}} - {{date("H:i", strtotime(Auth::user()->practicante->practica->fecha_sustentacion))}}

                @endif

            </dd>
            <dt class="mb-2 font-semibold leading-none text-gray-900">Etapa</dt>
            <dd class="mb-4 font-light text-gray-500 sm:mb-5">{{Auth::user()->practicante->practica->etapa}}</dd>
            <dt class="mb-2 font-semibold leading-none text-gray-900 dark:text-white">Estado</dt>
            <dd class="mb-4 font-light text-gray-500 sm:mb-5">{{Auth::user()->practicante->practica->estado}}</dd>
            <dt class="mb-2 font-semibold leading-none text-gray-900 dark:text-white">Resolución de prácticas</dt>
            <dd class="mb-4 font-light text-gray-500 sm:mb-5">
                @if (Auth::user()->practicante->practica->actas->contains('id', 6))
                
                @php
                $acta = Auth::user()->practicante->practica->actas->firstWhere('id', 6);
                @endphp
                
                <a target="_blank" href="{{route('practicante.verPDF',['name'=>$acta->documento_path])}}">
                    <svg class="w-6 h-6 text-blue-950" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 5h1v12a2 2 0 0 1-2 2m0 0a2 2 0 0 1-2-2V2a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v15a2 2 0 0 0 2 2h14ZM10 4h2m-2 3h2m-8 3h8m-8 3h8m-8 3h8M4 4h3v3H4V4Z" />
                    </svg>
                </a>
                @else
                No definido
                @endif
            </dd>
        </dl>
    </div>
    @endif

</section>
@endsection
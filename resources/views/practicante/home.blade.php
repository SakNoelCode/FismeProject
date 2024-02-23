@extends('layouts.practicas.app')

@section('title','Inicio')

@section('content')
<h3>Bienvenido, siga las instrucciones para que subir la documentación de sus prácticas</h3>

<section class="bg-white mt-6">
    <div class="py-2 px-4 mx-auto max-w-screen-xl text-center lg:py-2 lg:px-6">
        <div class="mx-auto mb-8 max-w-screen-sm lg:mb-4">
            <p class="font-semibold text-gray-500 sm:text-xl dark:text-gray-400">
                Modelos para los formatos de las actas
            </p>
        </div>
        <div class="grid gap-8 lg:gap-8 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
            <div class="text-center text-gray-500 dark:text-gray-400">
                <a target="_blank" href="{{asset('archivos/formato_plan_de_practicas.pdf')}}" class="font-medium text-blue-600 underline dark:text-blue-500 hover:no-underline">
                    descarga aquí
                </a>
                <p>Formato para el plan de prácticas</p>
            </div>
            <div class="text-center text-gray-500 dark:text-gray-400">
                <a target="_blank" href="{{asset('archivos/solicitud_aprobacion_practicas.pdf')}}" class="font-medium text-blue-600 underline dark:text-blue-500 hover:no-underline">
                    descarga aquí
                </a>
                <p>Solicitud para la aprobación de prácticas</p>
            </div>
            <div class="text-center text-gray-500 dark:text-gray-400">
                <a target="_blank" href="{{asset('archivos/solicitud_designacion_jurado.pdf')}}" class="font-medium text-blue-600 underline dark:text-blue-500 hover:no-underline">
                    descarga aquí
                </a>
                <p>Solicitud para la designación del jurado</p>
            </div>
            <div class="text-center text-gray-500 dark:text-gray-400">
                <a target="_blank" href="{{asset('archivos/solicitud_levantamiento_observaciones.pdf')}}" class="font-medium text-blue-600 underline dark:text-blue-500 hover:no-underline">
                    descarga aquí
                </a>
                <p>Solicitud para el levantamiento de observaciones</p>
            </div>
        </div>
    </div>
</section>

<!--Tarjeta de detalles de la práctica-->
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
                @if (Auth::user()->practicante->practica->actas()->where('tipoacta_id', 6)->exists())

                @php
                $acta = ($acta = Auth::user()->practicante->practica->actas->firstWhere('tipoacta_id', 6));
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
            <dt class="mb-2 font-semibold leading-none text-gray-900 dark:text-white">Cargo de solicitud dirigida al decano</dt>
            <dd class="mb-4 font-light text-gray-500 sm:mb-5">
                @if (Auth::user()->practicante->practica->actas()->where('tipoacta_id', 1)->exists() && Auth::user()->practicante->practica->actas->firstWhere('tipoacta_id', 1)->cargo_path)

                @php
                $acta = ($acta = Auth::user()->practicante->practica->actas->firstWhere('tipoacta_id', 1)->cargo_path);
                @endphp

                <a target="_blank" href="{{route('practicante.verPDF',['name'=>$acta])}}">
                    <svg class="w-6 h-6 text-blue-950" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 5h1v12a2 2 0 0 1-2 2m0 0a2 2 0 0 1-2-2V2a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v15a2 2 0 0 0 2 2h14ZM10 4h2m-2 3h2m-8 3h8m-8 3h8m-8 3h8M4 4h3v3H4V4Z" />
                    </svg>
                </a>
                @else
                No definido
                @endif
            </dd>

            @if (Auth::user()->practicante->practica->path_acta_sustentacion != null)
            <dt class="mb-2 font-semibold leading-none text-gray-900 dark:text-white">
                <span data-popover-target="popover-area" class="cursor-pointer">Resolución de informe final</span>

                <div data-popover id="popover-area" role="tooltip" class="absolute z-10 invisible inline-block w-64 text-sm text-gray-500 transition-opacity duration-300 bg-white border border-gray-200 rounded-lg shadow-sm opacity-0 dark:text-gray-400 dark:border-gray-600 dark:bg-gray-800">
                    <div class="px-3 py-2 bg-gray-100 border-b border-gray-200 rounded-t-lg dark:border-gray-600 dark:bg-gray-700">
                        <h3 class="font-semibold text-gray-900 dark:text-white">Resolución de informe final</h3>
                    </div>
                    <div class="px-3 py-2">
                        <p>Abra la resolución y verifique su estado, si esta aprobado recuerde presentar su empastado en Secretaría, si ha sido observado, repita el procedimiento desde el inicio.
                        </p>
                    </div>
                    <div data-popper-arrow></div>
                </div>
            </dt>
            @php
            $name = Auth::user()->practicante->practica->path_acta_sustentacion;
            @endphp
            <dd class="mb-4 font-light text-gray-500 sm:mb-5">
                <a target="_blank" href="{{route('practicante.verPDF',['name'=>$name])}}">
                    <svg class="w-6 h-6 text-blue-950" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 5h1v12a2 2 0 0 1-2 2m0 0a2 2 0 0 1-2-2V2a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v15a2 2 0 0 0 2 2h14ZM10 4h2m-2 3h2m-8 3h8m-8 3h8m-8 3h8M4 4h3v3H4V4Z" />
                    </svg>
                </a>
            </dd>
            @endif

        </dl>
    </div>
    @endif

</section>
@endsection
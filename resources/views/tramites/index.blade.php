@extends('layouts.tramite.app-tramite')

@section('title','Inicio')

@section('content')
<h3>Bienvenido, en esta página podrá realizar sus trámites.</h3>

<!--Tarjeta de detalles de la práctica-->
<section class="bg-white dark:bg-gray-900 mt-8">
    @if (Auth::user()->remitente == null)
    <p class="text-lg font-medium text-gray-900 dark:text-white text-center p-10">Aún no se define una práctica.</p>
    @else
    <div class="py-8 px-4 mx-auto max-w-3xl lg:py-8">
        <h2 class="mb-2 text-lg font-extrabold leading-none text-gray-900 md:text-lg">Datos del remitente</h2>
        <p class="mb-2 text-base leading-none text-gray-900 md:text-base">
            <span class="font-semibold">Razón Social:</span>
            {{Auth::user()->remitente->razon_social}}
        </p>
        <p class="mb-2 text-base leading-none text-gray-900 md:text-base">
            <span class="font-semibold">Tipo de documento:</span>
            {{strtoupper(Auth::user()->remitente->tipo_documento)}}
        </p>
        <p class="mb-2 text-base leading-none text-gray-900 md:text-base">
            <span class="font-semibold">Número de documento:</span>
            {{strtoupper(Auth::user()->remitente->numero_documento)}}
        </p>

    </div>
    @endif

</section>

@endsection
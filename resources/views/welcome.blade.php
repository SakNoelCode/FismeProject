@extends('layouts.home')

@section('title',' - Inicio')

@push('css')

@endpush

@section('content')

<div class="container max-w-lg px-4 py-32 mx-auto text-left md:max-w-none md:text-center">
    <h1 class="text-5xl font-extrabold leading-10 tracking-tight text-left text-gray-900 md:text-center sm:leading-none md:text-6xl lg:text-7xl"><span class="inline md:block">Bienvenido al</span> <span class="relative mt-2 text-transparent bg-clip-text bg-gradient-to-br from-blue-600 to-blue-500 md:inline-block">Sistema de la fisme</span></h1>
    <div class="mx-auto mt-5 text-gray-500 md:mt-12 md:max-w-lg md:text-center lg:text-lg">Este sistema le ayudará a realizar seguimiento de tesis, sus prácticas y poder gestionar el trámite documentario</div>
</div>

@endsection

@push('js')

@endpush
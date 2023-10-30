@extends('layouts.home')

@section('title',' - Inicio')

@push('css')

@endpush

@section('content')

<header class="antialiased">
    <nav class="bg-white border-b-2 border-gray-400 px-4 lg:px-6 py-2.5 dark:bg-gray-800">
        <div class="flex flex-wrap justify-between items-center">
            <img src="{{asset('img/fisme.svg')}}" class="mx-auto h-14" alt="Fisme Logo" />
        </div>
    </nav>
</header>

<section class="bg-blue-400">
  <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16 lg:px-6">
      
      <div class="space-y-8 lg:grid lg:grid-cols-3 sm:gap-6 xl:gap-10 lg:space-y-0">

          <!-- Proyectos de tesis-->
          <div class="flex flex-col p-6 mx-auto max-w-lg text-center text-gray-900 bg-white rounded-lg border border-gray-100 shadow dark:border-gray-600 xl:p-8 dark:bg-gray-800 dark:text-white">
              <h3 class="mb-4 text-2xl font-semibold">Gestión de proyectos de tesis</h3>
              <p class="font-light text-gray-700 sm:text-lg dark:text-gray-400">Eres egresado y buscar tramitar tu proyecto de tesis.</p>
                           
              <a href="{{route('login')}}" class="text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:ring-blue-200 font-medium rounded-lg text-sm px-5 py-2.5 text-center my-4">Ingresa aquí</a>
          </div>
          
          <!-- Trámite documentario -->
          <div class="flex flex-col p-6 mx-auto max-w-lg text-center text-gray-900 bg-white rounded-lg border border-gray-100 shadow dark:border-gray-600 xl:p-8 dark:bg-gray-800 dark:text-white">
              <h3 class="mb-4 text-2xl font-semibold">Trámite documentario externo</h3>
              <p class="font-light text-gray-700 sm:text-lg dark:text-gray-400">Quieres enviar un documento a la mesa de partes de la facultad.</p>
                           
              <a href="{{route('login.tramite')}}" class="text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:ring-blue-200 font-medium rounded-lg text-sm px-5 py-2.5 text-center my-4">Ingresa aquí</a>
          </div>
          
          <!-- Prácticas -->
          <div class="flex flex-col p-6 mx-auto max-w-lg text-center text-gray-900 bg-white rounded-lg border border-gray-100 shadow dark:border-gray-600 xl:p-8 dark:bg-gray-800 dark:text-white">
              <h3 class="mb-4 text-2xl font-semibold">Gestion de Prácticas preprofesionales</h3>
              <p class="font-light text-gray-700 sm:text-lg dark:text-gray-400">Quieres hacer tus prácticas y buscar tramitarlo.</p>
                           
              <a href="#" class="text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:ring-blue-200 font-medium rounded-lg text-sm px-5 py-2.5 text-center my-4">Ingresa aquí</a>
          </div>
          
      </div>
  </div>
</section>


@endsection

@push('js')

@endpush
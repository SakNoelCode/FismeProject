@extends('layouts.home')

@section('title',' - Mesa de partes')

@push('css')

@endpush

@section('content')

<section class="bg-gray-100 dark:bg-gray-900 mt-14">
    <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-8">


        <!-- Breadcrumb -->
        <nav class="flex sm:mx-9 px-5 py-3 text-gray-700 border border-gray-200 rounded-lg bg-white dark:bg-gray-800 dark:border-gray-700" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                    <a href="/" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white">
                        <svg class="w-3 h-3 mr-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z" />
                        </svg>
                        Inicio
                    </a>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg class="w-3 h-3 mx-1 text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4" />
                        </svg>
                        <a href="{{route('mesa-de-partes')}}" class="ml-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ml-2 dark:text-gray-400 dark:hover:text-white">Mesa de partes</a>
                    </div>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <svg class="w-3 h-3 mx-1 text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4" />
                        </svg>
                        <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2 dark:text-gray-400">Realizar trámite</span>
                    </div>
                </li>
            </ol>
        </nav>


        <!----Indicador--->
        <!--ol class="flex items-center mt-5">
            <li class="relative w-full mb-6">
                <div class="flex items-center">
                    <div class="z-10 flex items-center justify-center w-6 h-6 bg-blue-600 rounded-full ring-0 ring-white dark:bg-blue-900 sm:ring-8 dark:ring-gray-900 shrink-0">
                        <svg class="w-2.5 h-2.5 text-blue-100 dark:text-blue-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 16 12">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5.917 5.724 10.5 15 1.5" />
                        </svg>
                    </div>
                    <div class="flex w-full bg-gray-200 h-0.5 dark:bg-gray-700"></div>
                </div>
                <div class="mt-3">
                    <h3 class="font-medium text-gray-900 dark:text-white">Datos del remitente</h3>
                </div>
            </li>
            <li class="relative w-full mb-6">
                <div class="flex items-center">
                    <div class="z-10 flex items-center justify-center w-6 h-6 bg-gray-200 rounded-full ring-0 ring-white dark:bg-gray-700 sm:ring-8 dark:ring-gray-900 shrink-0">
                        <svg class="w-2.5 h-2.5 text-gray-900 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 16 12">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5.917 5.724 10.5 15 1.5" />
                        </svg>
                    </div>
                    <div class="flex w-full bg-gray-200 h-0.5 dark:bg-gray-700"></div>
                </div>
                <div class="mt-3">
                    <h3 class="font-medium text-gray-900 dark:text-white">Datos del expediente</h3>
                </div>
            </li>

        </ol--->

        <form method="post" action="{{route('expedientes.store')}}" enctype="multipart/form-data">
            @csrf

            <div class="py-6">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

                    <!---Section remitente--->
                    <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                        <div class="max-w-xl">

                            <section>
                                <header>
                                    <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                        Información del remitente
                                    </h2>

                                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                        Ingrese sus datos correctamente
                                    </p>
                                </header>

                                <div class="mt-6 space-y-6">
                                    <div>
                                        <x-input-label for="razon_social" :value="__('Razón social')" />
                                        <x-text-input id="razon_social" name="razon_social" type="text" class="mt-1 block w-full" :value="old('razon_social')" required autofocus placeholder="nombre y apellidos o nombre de la empresa" />
                                        <x-input-error class="mt-2" :messages="$errors->get('razon_social')" />
                                    </div>

                                    <div>
                                        <x-input-label for="numero_documento" :value="__('Número de documento')" />
                                        <x-text-input id="numero_documento" name="numero_documento" type="text" class="mt-1 block w-full" :value="old('numero_documento')" required placeholder="DNI o RUC" />
                                        <x-input-error class="mt-2" :messages="$errors->get('numero_documento')" />
                                    </div>

                                    <div>
                                        <x-input-label for="email" :value="__('Correo eléctronico')" />
                                        <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email')" required placeholder="dirección de correo eléctronico" />
                                        <x-input-error class="mt-2" :messages="$errors->get('email')" />
                                    </div>
                                </div>

                            </section>




                        </div>
                    </div>

                    <!---Section Datos Generales--->
                    <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                        <div class="max-w-xl">

                            <section>
                                <header>
                                    <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                        Información del documento
                                    </h2>

                                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                        Ingrese los datos correspodientes al trámite que desea realizar
                                    </p>
                                </header>


                                <div class="mt-6 space-y-6">

                                    <div>
                                        <x-input-label for="tipo" :value="__('Tipo de documento')" />
                                        <select name="tipo" id="tipo" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                                            <option value="solicitud">Solicitud</option>
                                            <option value="carta">Carta</option>
                                            <option value="memorando">Memorando</option>
                                            <option value="oficio">Oficio</option>
                                        </select>
                                        <x-input-error class="mt-2" :messages="$errors->get('tipo')" />
                                    </div>

                                    <div>
                                        <x-input-label for="descripcion" :value="__('Descripción')" />
                                        <textarea name="descripcion" id="descripcion" rows="4" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" placeholder="Ingrese una breve descripción de su documento" required>{{old('descripcion')}}</textarea>
                                        <x-input-error class="mt-2" :messages="$errors->get('descripcion')" />
                                    </div>

                                    <div>
                                        <x-input-label for="nombre_path" :value="_('Cargue su documento (Solo archivos .pdf y .docx)')" />
                                        <x-text-input id="nombre_path" name="nombre_path" type="file" class="mt-1 block w-full" :value="old('nombre_path')" required accept=".pdf,.doc,.docx,.xml,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document" />
                                    </div>

                                </div>
                            </section>


                        </div>
                    </div>

                    <!---Section Button--->
                    <div class="p-4">
                        <div class="text-center">
                            <x-primary-button>Enviar trámite</x-primary-button>
                        </div>
                    </div>

                </div>
            </div>

        </form>

    </div>
</section>

@endsection

@push('js')

@endpush
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
                        <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2 dark:text-gray-400">Consultar trámite</span>
                    </div>
                </li>
            </ol>
        </nav>



        <div class="py-6">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

                <!---Section Formulario Buscar--->
                <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                    <div class="max-w-xl">

                        <section>
                            <header>
                                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                    Consultar trámite
                                </h2>

                                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                    Ingrese los datos que se piden a continuación, estos datos se generaron en su cargo.
                                </p>
                            </header>


                            <form method="get" action="{{route('expediente.buscar')}}" class="mt-6 space-y-6">

                                <div>
                                    <x-input-label for="numeracion" :value="__('Número de expediente')" />
                                    <x-text-input id="numeracion" name="numeracion" type="text" class="mt-1 block w-full" :value="old('numeracion')" required autofocus placeholder="00042" />
                                    <x-input-error class="mt-2" :messages="$errors->get('numeracion')" />
                                </div>

                                <div>
                                    <x-input-label for="codigo" :value="__('Código de seguridad')" />
                                    <x-text-input id="codigo" name="codigo" type="text" class="mt-1 block w-full" :value="old('codigo')" required placeholder="HB087A" />
                                    <x-input-error class="mt-2" :messages="$errors->get('codigo')" />
                                </div>

                                <div class="flex items-center gap-4">
                                    <x-primary-button>Consultar trámite</x-primary-button>
                                </div>

                            </form>

                        </section>




                    </div>
                </div>

                <!--Section datos del expedeinte buscado--->
                @if (isset($expediente))
                <div class="p-4 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                    <div class="max-w-xl">


                        <section>

                            <header>
                                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                    Datos del expediente
                                </h2>

                            </header>

                            <div class="grid gap-4 sm:grid-cols-2 sm:gap-4 mt-4">

                                <div>
                                    <x-input-label for="numeracion_expediente" :value="__('Número de expediente')" />
                                    <x-text-input disabled id="numeracion_expediente" type="text" class="mt-1 block w-full" :value="$expediente->numeracion" />
                                </div>

                                <div>
                                    <x-input-label for="fecha_recepcion" :value="__('Fecha de recepción')" />
                                    <x-text-input disabled id="fecha_recepcion" type="text" class="mt-1 block w-full" :value='date("d/m/Y", strtotime($expediente->fecha_recepcion))' />
                                </div>

                                <div>
                                    <x-input-label for="remitente" :value="__('Remitente')" />
                                    <x-text-input disabled id="remitente" type="text" class="mt-1 block w-full" :value="$expediente->remitente->razon_social" />
                                </div>
                                <div>
                                    <x-input-label for="numero_documento" :value="__('Número de documento (DNI / RUC)')" />
                                    <x-text-input disabled id="numero_documento" type="text" class="mt-1 block w-full" :value="$expediente->remitente->numero_documento" />
                                </div>
                                <div>
                                    <x-input-label for="tipo_documento" :value="__('Tipo de documento')" />
                                    <x-text-input disabled id="tipo_documento" type="text" class="mt-1 block w-full" :value="$expediente->documento->tipo" />
                                </div>
                                <div>
                                    <x-input-label for="estado" :value="__('Estado')" />
                                    <x-text-input disabled id="estado" type="text" class="mt-1 block w-full" :value="$expediente->estado" />
                                </div>

                            </div>

                        </section>

                    </div>
                </div>
                @elseif (isset($numero_expediente))
                <div class="p-4 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                    <div class="max-w-xl">

                        <section>

                            <header>
                                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                    No se encontrarón resultados.
                                </p>

                            </header>
                        </section>

                    </div>
                </div>
                @endif


                <!--Section para el registro de historiales--->
                @if (isset($expediente->historiales) && count($expediente->historiales))
                <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                    <div class="max-w-xl">

                        <section>
                            <header>
                                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                    Historial del expediente
                                </h2>

                                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                    Vea por que áreas ha pasado su documento, la respuesta de cada areá y los documentos adjuntos.
                                </p>
                            </header>

                        </section>


                    </div>
                </div>
                @else

                @if (isset($numero_expediente))
                <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                    <div class="max-w-xl">

                        <section>
                            <header>
                                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                    Historial del expediente
                                </h2>

                                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                    Su documemto aún no cuenta con un historial.
                                </p>
                            </header>

                        </section>


                    </div>
                </div>
                @endif

                @endif




            </div>
        </div>



    </div>
</section>

@endsection

@push('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    $(document).ready(function() {
        let input = $('#codigo');

        input.on('keyup', function() {
            let textoEnMayusculas = input.val().toUpperCase();
            input.val(textoEnMayusculas);
        });
    });
</script>
@endpush
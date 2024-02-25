@extends('layouts.practicas.app')

@section('title','Generar solicitud dirigida al decano')

@section('content')

<section class="flex justify-end mb-3 space-x-4">
    <a href="{{route('practicante.createActas')}}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
        Volver
    </a>
</section>

<section>
    <form action="{{route('practicante.generateSolicitudAprobacionPracticaPDF')}}" method="post">
        @csrf

        <div class="mx-auto max-w-screen-xl">
            <div class="space-y-8 lg:grid lg:grid-cols-2 sm:gap-6 xl:gap-6 lg:space-y-0">

                <div>
                    <x-input-label for='nameDecano' value='Nombre y apellidos del decano(*):' class="text-xs" />
                    <x-text-input required type='text' id="nameDecano" name='nameDecano' :value="old('nameDecano')" class="text-xs mt-2 block w-full" />
                    <x-input-error :messages="$errors->get('nameDecano')" class="mt-2 text-xs" />
                </div>

                <div>
                    <x-input-label for='direccion' value='Dirección actual(*):' class="text-xs" />
                    <x-text-input required type='text' id="direccion" name='direccion' :value="old('direccion')" class="text-xs mt-2 block w-full" />
                    <x-input-error :messages="$errors->get('direccion')" class="mt-2 text-xs" />
                </div>

                <div>
                    <x-input-label for='year' value='Nombre del año(*):' class="text-xs" />
                    <x-text-input required type='text' id="year" name='year' :value="old('year')" class="text-xs mt-2 block w-full" />
                    <x-input-error :messages="$errors->get('year')" class="mt-2 text-xs" />
                </div>

            </div>
        </div>

        <div class="mt-5 flex items-center gap-4">
            <x-primary-button>Generar</x-primary-button>
        </div>
    </form>
</section>
@endsection
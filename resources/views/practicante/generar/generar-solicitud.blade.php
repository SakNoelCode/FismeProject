@extends('layouts.practicas.app')

@section('title','Generar solicitud para la designación de Jurado Evaluador')

@section('content')
<section>
    <form action="{{route('practicante.generar-solicitud-designacion-jurado')}}" method="post">
        @csrf

        <div class="mx-auto max-w-screen-xl">
            <div class="space-y-8 lg:grid lg:grid-cols-2 sm:gap-6 xl:gap-6 lg:space-y-0">

                <div>
                    <x-input-label for='nameDirector' value='Nombre y apellidos del director de Escuela(*):' class="text-xs" />
                    <x-text-input required type='text' id="nameDirector" name='nameDirector' :value="old('nameDirector')" class="text-xs mt-2 block w-full" />
                    <x-input-error :messages="$errors->get('nameDirector')" class="mt-2 text-xs" />
                </div>

                <div>
                    <x-input-label for='direccion' value='Dirección actual del estudiante(*):' class="text-xs" />
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
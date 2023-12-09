@extends('layouts.practicas.app')

@section('title','Completar datos')

@section('content')
<section>
    <form action="{{route('practicante.storePracticante')}}" method="post">
        @csrf

        <div class="mx-auto max-w-screen-xl">
            <div class="space-y-8 lg:grid lg:grid-cols-3 sm:gap-6 xl:gap-6 lg:space-y-0">

                <div>
                    <x-input-label for='razon_social' value='Nombres y Apellidos(*):' class="text-xs" />
                    <x-text-input required type='text' id="razon_social" name='razon_social' :value="old('razon_social',Auth::user()->practicante->razon_social)" class="text-xs mt-2 block w-full" />
                    <x-input-error :messages="$errors->get('razon_social')" class="mt-2 text-xs" />
                </div>

                <div>
                    <x-input-label for='codigo_estudiante' value='Código de estudiante(*):' class="text-xs" />
                    <x-text-input required type='text' id="codigo_estudiante" name='codigo_estudiante' :value="old('codigo_estudiante',Auth::user()->practicante->codigo_estudiante)" class="text-xs mt-2 block w-full" />
                    <x-input-error :messages="$errors->get('codigo_estudiante')" class="mt-2 text-xs" />
                </div>

                <div>
                    <x-input-label for='escuela_id' value='Escuela profesional(*):' class="text-xs" />
                    <select required id="escuela_id" name='escuela_id' class="text-xs mt-2 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                        <option value="">Seleccione</option>
                        @foreach ($escuelas as $escuela)
                        @if ($escuela->id === Auth::user()->practicante->escuela_id)
                        <option selected value="{{ $escuela->id }}" @selected(old('escuela_id')==$escuela->id)>
                            {{ ucfirst($escuela->name) }}
                        </option>
                        @else
                        <option value="{{ $escuela->id }}" @selected(old('escuela_id')==$escuela->id)>
                            {{ ucfirst($escuela->name) }}
                        </option>
                        @endif
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('escuela_id')" class="text-xs mt-2" />
                </div>

                <div>
                    <x-input-label for='telefono' value='Teléfono:' class="text-xs" />
                    <x-text-input type='number' id="telefono" name='telefono' :value="old('telefono',Auth::user()->practicante->telefono)" class="text-xs mt-2 block w-full" />
                    <x-input-error :messages="$errors->get('telefono')" class="mt-2 text-xs" />
                </div>

            </div>
        </div>

        <div class="mt-5 flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'practicante.saved')
            <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-sm text-gray-600 dark:text-gray-400">{{ __('Guardado.') }}</p>
            @endif
        </div>
    </form>
</section>
@endsection
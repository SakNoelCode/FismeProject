@extends('layouts.practicas.app')

@section('title','Seleccione a su asesor')

@section('content')
<section>
    <form action="{{route('practicante.storePractica')}}" method="post">
        @csrf

        <div class="mx-auto max-w-screen-xl">
            <div class="space-y-8 lg:grid lg:grid-cols-3 sm:gap-6 xl:gap-6 lg:space-y-0">

                <div>
                    <x-input-label for='asesore_id' value='Asesor(*):' class="text-xs" />
                    <select required id="asesore_id" name='asesore_id' class="text-xs mt-2 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                        <option value="">Seleccione</option>
                        @foreach ($asesores as $item)
                        @if ($item->id === Auth::user()->practicante->asesore_id)
                        <option selected value="{{ $item->id }}" @selected(old('asesore_id')==$item->id)>
                            {{ ucfirst($item->user->name) }}
                        </option>
                        @else
                        <option value="{{ $item->id }}" @selected(old('asesore_id')==$item->id)>
                            {{ ucfirst($item->user->name) }}
                        </option>
                        @endif
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('asesore_id')" class="mt-2 text-xs" />
                </div>

            </div>
        </div>

        <div class="mt-5 flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'practica.saved')
            <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-sm text-gray-600 dark:text-gray-400">{{ __('Guardado.') }}</p>
            @endif
        </div>
    </form>
</section>
@endsection
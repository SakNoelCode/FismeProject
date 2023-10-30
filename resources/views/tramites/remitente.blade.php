@extends('layouts.tramite.app-tramite')

@section('title','Datos del remitente')

@section('content')
<section>
    <form action="{{route('tramite.storeDatosRemitente')}}" method="post">
        @csrf

        <div class="mx-auto max-w-screen-xl">
            <div class="space-y-8 lg:grid lg:grid-cols-3 sm:gap-6 xl:gap-10 lg:space-y-0">

                <div>
                    <x-input-label for='razon_social' value='Razón Social(*):' class="text-xs" />
                    <x-text-input class="text-xs mt-2 block w-full" type='text' id="razon_social" name='razon_social' required autocomplete='razon_social' :value="old('razon_social',Auth::user()->remitente->razon_social)" />
                    <x-input-error class="mt-2 text-xs" :messages="$errors->get('razon_social')" />
                </div>

                <div>
                    <x-input-label for='tipo_documento' value='Tipo de documento(*):' class="text-xs" />
                    <select class="text-xs mt-2 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" id="tipo_documento" name='tipo_documento' required autocomplete='tipo_documento'>
                        @php
                        $tiposDocumentos = ['dni', 'ruc', 'pasaporte'];
                        $selectedTipo = Auth()->user()->remitente->tipo_documento;
                        @endphp

                        @foreach ($tiposDocumentos as $tipo)
                        <option value="{{ $tipo }}" {{ $tipo === $selectedTipo ? 'selected' : '' }}>
                            {{ ucfirst($tipo) }}
                        </option>
                        @endforeach

                    </select>
                    <x-input-error class="text-xs mt-2" :messages="$errors->get('tipo_documento')" />
                </div>

                <div>
                    <x-input-label for='numero_documento' value='Número de documento(*):' class="text-xs" />
                    <x-text-input class="text-xs mt-2 block w-full" type='number' id="numero_documento" name='numero_documento' required autocomplete='numero_documento' :value="old('numero_documento',Auth::user()->remitente->numero_documento)" />
                    <x-input-error class="mt-2 text-xs" :messages="$errors->get('numero_documento')" />
                </div>

            </div>
        </div>

        <div class="mt-5 flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'remitente.saved')
            <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-sm text-gray-600 dark:text-gray-400">{{ __('Guardado.') }}</p>
            @endif
        </div>
    </form>
</section>
@endsection
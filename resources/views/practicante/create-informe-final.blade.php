@extends('layouts.practicas.app')

@section('title','Subir informe final')

@section('content')
<div class="bg-blue-600/30 rounded-xl px-5 sm:px-10 py-4 relative mb-6">
    <form action="{{route('practicante.store-informe-final')}}" method="post" enctype="multipart/form-data">
        @csrf

        <div class="mx-auto max-w-screen-xl">
            <div class="space-y-8 lg:grid lg:grid-cols-2 sm:gap-6 xl:gap-6 lg:space-y-0">

                <div>
                    <x-input-label for='documento_path' value='Subir informe final de prácticas(*) (PDF):' class="text-xs" />
                    <x-text-input required type='file' id="documento_path" name='documento_path' class="text-xs mt-2 block w-full" />
                    <x-input-error :messages="$errors->get('documento_path')" class="mt-2 text-xs" />
                </div>

                <div>
                    @if (Auth::user()->practicante->practica->path_informe_final == null)
                    <p class="text-xs">No se ha subido ningún documento aún.</p>
                    @else
                    <p class="text-xs mb-4">Documento subido:</p>
                    <a target="_blank" href="{{route('practicante.verPDFInforme',['name'=>Auth::user()->practicante->practica->path_informe_final])}}">
                        <svg class="w-6 h-6 text-blue-950" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 5h1v12a2 2 0 0 1-2 2m0 0a2 2 0 0 1-2-2V2a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v15a2 2 0 0 0 2 2h14ZM10 4h2m-2 3h2m-8 3h8m-8 3h8m-8 3h8M4 4h3v3H4V4Z" />
                        </svg>
                    </a>
                    @endif

                </div>

            </div>
        </div>

        <div class="mt-5 flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'saved')
            <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-sm text-gray-600 dark:text-gray-400">{{ __('Guardado.') }}</p>
            @endif
        </div>
    </form>
</div>

@endsection
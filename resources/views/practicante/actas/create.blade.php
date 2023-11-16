@extends('layouts.practicas.app')

@section('title','Subir documentación')

@section('content')

<div class="bg-blue-600/30 rounded-xl px-5 sm:px-10 py-4 relative">
    <form action="" method="post">
        @csrf

        <div class="mx-auto max-w-screen-xl">
            <div class="space-y-8 lg:grid lg:grid-cols-3 sm:gap-6 xl:gap-6 lg:space-y-0">

                <div>
                    <x-input-label for='razon_social' value='Subir solicitud dirida al decano(*):' class="text-xs" />
                    <x-text-input required type='file' id="razon_social" name='razon_social' class="text-xs mt-2 block w-full" />
                    <x-input-error :messages="$errors->get('razon_social')" class="mt-2 text-xs" />
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
</div>

<div class="bg-blue-100/70 mt-12 rounded-xl px-5 sm:px-10 pt-8 pb-4 relative">
    Hola
</div>

<div class="bg-blue-100/70 mt-12 rounded-xl px-5 sm:px-10 pt-8 pb-4 relative">
    Hola
</div>


<section>

</section>


@endsection
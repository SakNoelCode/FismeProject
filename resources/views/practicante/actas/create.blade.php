@extends('layouts.practicas.app')

@section('title','Subir documentación')

@section('content')

<div class="bg-blue-600/30 rounded-xl px-5 sm:px-10 py-4 relative mb-6">
    <form action="{{route('practicante.storeActas')}}" method="post" enctype="multipart/form-data">
        @csrf

        <div class="mx-auto max-w-screen-xl">
            <div class="space-y-8 lg:grid lg:grid-cols-3 sm:gap-6 xl:gap-6 lg:space-y-0">

                <div>
                    <div class="mt-6">
                        <a target="_blank" href="{{route('practicante.generateSolicitudAprobacionPractica')}}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 focus:outline-none">
                            Generar documento
                        </a>
                    </div>
                </div>

                <div>
                    <x-input-label for='documento_path' value='Subir solicitud dirida al decano(*) (PDF):' class="text-xs" />
                    <input type="hidden" name="tipo" value="1">
                    @if (Auth::user()->practicante->practica->etapa == 'Inicio' || Auth::user()->practicante->practica->etapa =='Observado')
                    <x-text-input required type='file' id="documento_path" name='documento_path' class="text-xs mt-2 block w-full" />
                    @else
                    <x-text-input disabled type='file' id="documento_path" name='documento_path' class="text-xs mt-2 block w-full" />
                    @endif
                    <x-input-error :messages="$errors->get('documento_path')" class="mt-2 text-xs" />
                </div>

                <div>
                    @if ($acta1 === null)
                    <p class="text-xs">No se ha subido ningún documento aún.</p>
                    @else
                    <p class="text-xs mb-4">Documento subido:</p>
                    <a target="_blank" href="{{route('practicante.verPDF',['name'=>$acta1->documento_path])}}">
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

            @if (session('status') === 'acta1.saved')
            <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-sm text-gray-600 dark:text-gray-400">{{ __('Guardado.') }}</p>
            @endif
        </div>
    </form>
</div>

<div class="bg-blue-600/30 rounded-xl px-5 sm:px-10 py-4 relative mb-6">
    <form action="{{route('practicante.storeActas')}}" method="post" enctype="multipart/form-data">
        @csrf

        <div class="mx-auto max-w-screen-xl">
            <div class="space-y-8 lg:grid lg:grid-cols-2 sm:gap-6 xl:gap-6 lg:space-y-0">

                <div>
                    <x-input-label for='documento_path' value='Subir constancia de cursos aprobados (*) (PDF):' class="text-xs" />
                    <input type="hidden" name="tipo" value="2">
                    @if (Auth::user()->practicante->practica->etapa == 'Inicio' || Auth::user()->practicante->practica->etapa =='Observado')
                    <x-text-input required type='file' id="documento_path" name='documento_path' class="text-xs mt-2 block w-full" />
                    @else
                    <x-text-input disabled type='file' id="documento_path" name='documento_path' class="text-xs mt-2 block w-full" />
                    @endif
                    <x-input-error :messages="$errors->get('documento_path')" class="mt-2 text-xs" />
                </div>

                <div>
                    @if ($acta2 === null)
                    <p class="text-xs">No se ha subido ningún documento aún.</p>
                    @else
                    <p class="text-xs mb-4">Documento subido:</p>
                    <a target="_blank" href="{{route('practicante.verPDF',['name'=>$acta2->documento_path])}}">
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

            @if (session('status') === 'acta2.saved')
            <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-sm text-gray-600 dark:text-gray-400">{{ __('Guardado.') }}</p>
            @endif
        </div>
    </form>
</div>

<div class="bg-blue-600/30 rounded-xl px-5 sm:px-10 py-4 relative mb-6">
    <form action="{{route('practicante.storeActas')}}" method="post" enctype="multipart/form-data">
        @csrf

        <div class="mx-auto max-w-screen-xl">
            <div class="space-y-8 lg:grid lg:grid-cols-2 sm:gap-6 xl:gap-6 lg:space-y-0">

                <div>
                    <x-input-label for='documento_path' value='Subir Plan de prácticas (Avaladas y firmadas por el asesor)(*) (PDF):' class="text-xs" />
                    <input type="hidden" name="tipo" value="3">
                    @if (Auth::user()->practicante->practica->etapa == 'Inicio' || Auth::user()->practicante->practica->etapa =='Observado')
                    <x-text-input required type='file' id="documento_path" name='documento_path' class="text-xs mt-2 block w-full" />
                    @else
                    <x-text-input disabled type='file' id="documento_path" name='documento_path' class="text-xs mt-2 block w-full" />
                    @endif
                    <x-input-error :messages="$errors->get('documento_path')" class="mt-2 text-xs" />
                </div>

                <div>
                    @if ($acta3 === null)
                    <p class="text-xs">No se ha subido ningún documento aún.</p>
                    @else
                    <p class="text-xs mb-4">Documento subido:</p>
                    <a target="_blank" href="{{route('practicante.verPDF',['name'=>$acta3->documento_path])}}">
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

            @if (session('status') === 'acta3.saved')
            <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-sm text-gray-600 dark:text-gray-400">{{ __('Guardado.') }}</p>
            @endif
        </div>
    </form>
</div>

<div class="bg-blue-600/30 rounded-xl px-5 sm:px-10 py-4 relative mb-6">
    <form action="{{route('practicante.storeActas')}}" method="post" enctype="multipart/form-data">
        @csrf

        <div class="mx-auto max-w-screen-xl">
            <div class="space-y-8 lg:grid lg:grid-cols-2 sm:gap-6 xl:gap-6 lg:space-y-0">

                <div>
                    <x-input-label for='documento_path' value='Subir Carta de autorización emitida por la empresa(*) (PDF):' class="text-xs" />
                    <input type="hidden" name="tipo" value="4">
                    @if (Auth::user()->practicante->practica->etapa == 'Inicio' || Auth::user()->practicante->practica->etapa =='Observado')
                    <x-text-input required type='file' id="documento_path" name='documento_path' class="text-xs mt-2 block w-full" />
                    @else
                    <x-text-input disabled type='file' id="documento_path" name='documento_path' class="text-xs mt-2 block w-full" />
                    @endif
                    <x-input-error :messages="$errors->get('documento_path')" class="mt-2 text-xs" />
                </div>

                <div>
                    @if ($acta4 === null)
                    <p class="text-xs">No se ha subido ningún documento aún.</p>
                    @else
                    <p class="text-xs mb-4">Documento subido:</p>
                    <a target="_blank" href="{{route('practicante.verPDF',['name'=>$acta4->documento_path])}}">
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

            @if (session('status') === 'acta4.saved')
            <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-sm text-gray-600 dark:text-gray-400">{{ __('Guardado.') }}</p>
            @endif
        </div>
    </form>
</div>

<div class="bg-blue-600/30 rounded-xl px-5 sm:px-10 py-4 relative mb-6">
    <form action="{{route('practicante.storeActas')}}" method="post" enctype="multipart/form-data">
        @csrf

        <div class="mx-auto max-w-screen-xl">
            <div class="space-y-8 lg:grid lg:grid-cols-2 sm:gap-6 xl:gap-6 lg:space-y-0">

                <div>
                    <x-input-label for='documento_path' value='Subir Comprobante de pago por derecho de Carta de Presentación(*) (PDF):' class="text-xs" />
                    <input type="hidden" name="tipo" value="5">
                    @if (Auth::user()->practicante->practica->etapa == 'Inicio' || Auth::user()->practicante->practica->etapa =='Observado')
                    <x-text-input required type='file' id="documento_path" name='documento_path' class="text-xs mt-2 block w-full" />
                    @else
                    <x-text-input disabled type='file' id="documento_path" name='documento_path' class="text-xs mt-2 block w-full" />
                    @endif

                    <x-input-error :messages="$errors->get('documento_path')" class="mt-2 text-xs" />
                </div>

                <div>
                    @if ($acta5 === null)
                    <p class="text-xs">No se ha subido ningún documento aún.</p>
                    @else
                    <p class="text-xs mb-4">Documento subido:</p>
                    <a target="_blank" href="{{route('practicante.verPDF',['name'=>$acta5->documento_path])}}">
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

            @if (session('status') === 'acta5.saved')
            <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-sm text-gray-600 dark:text-gray-400">{{ __('Guardado.') }}</p>
            @endif
        </div>
    </form>
</div>

@endsection
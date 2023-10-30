@extends('layouts.tramite.app-tramite')

@section('title','Expedientes')

@section('content')

<section class="flex justify-end">
    <x-dropdown align="right" width="52">
        <x-slot name="trigger">
            <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                <div>Acciones</div>

                <div class="ml-1">
                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </div>
            </button>
        </x-slot>

        <x-slot name="content">
            <x-dropdown-link :href="route('tramite.createExpedienteRemitente')" class="cursor-pointer">
                Nuevo expediente
            </x-dropdown-link>

        </x-slot>
    </x-dropdown>
</section>

@include('include.alert')

<div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-5">

    <table class="w-full text-xs text-left text-gray-500 dark:text-gray-400">
        <caption class="p-5 text-sm font-semibold text-left text-gray-900 bg-white dark:text-white dark:bg-gray-800">
            Tabla de expedientes
            <p class="mt-1 text-xs font-normal text-gray-500 dark:text-gray-400">
                Consulte los expedientes que ha realizado.
            </p>
            @if ($expedientes->isEmpty())
            <div class="px-6 py-4">
                <p class="text-center text-gray-900 dark:text-white">No hay registros</p>
            </div>
        </caption>
        @else

        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Fecha y Hora
                </th>
                <th scope="col" class="px-6 py-3">
                    Asunto
                </th>
                <th scope="col" class="px-6 py-3">
                    Documentos
                </th>
                <th scope="col" class="px-6 py-3">
                    Area encargada
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($expedientes as $item)
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                <th class="px-6 py-4">
                    {{date("d/m/Y", strtotime($item->created_at))}} - {{date("H.i", strtotime($item->created_at))}}
                </th>
                <td class="px-6 py-4">
                    {{$item->asunto}}
                </td>
                <td class="px-6 py-4">
                    @foreach ($item->documentos as $documento)
                    <div class="inline-block mr-2">
                        <a target="_blank" href="{{route('tramite.verPdfExpediente',['name'=>$documento->nombre_path])}}">
                            <svg class="w-[20px] h-[20px] text-blue-600 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 14">
                                <g stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                                    <path d="M10 10a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" />
                                    <path d="M10 13c4.97 0 9-2.686 9-6s-4.03-6-9-6-9 2.686-9 6 4.03 6 9 6Z" />
                                </g>
                            </svg>
                        </a>
                    </div>
                    @endforeach
                </td>
                <td class="px-6 py-4">
                    {{$item->area->nombre}}
                </td>
            </tr>
            @endforeach
        </tbody>

        @endif
    </table>
</div>


@endsection
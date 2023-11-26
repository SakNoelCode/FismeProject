@extends('layouts.tramite.app-tramite')

@section('title','Respuestas')

@section('content')

<!---section class="flex justify-end">
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
</section---->

@include('include.alert')

<div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-5">

    <table class="w-full text-xs text-left text-gray-500 dark:text-gray-400">
        <caption class="p-5 text-sm font-semibold text-left text-gray-900 bg-white dark:text-white dark:bg-gray-800">
            Tabla de respuestas
            <p class="mt-1 text-xs font-normal text-gray-500 dark:text-gray-400">
                Consulte las respuestas que tiene su expediente.
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
                    Numeración
                </th>
                <th scope="col" class="px-6 py-3">
                    Asunto
                </th>
                <th scope="col" class="px-6 py-3">
                    Estado
                </th>
                <th scope="col" class="px-6 py-3">
                    Ver respuesta
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($expedientes as $item)
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                <th class="px-6 py-4">
                    {{$item->numeracion}}
                </th>
                <td class="px-6 py-4">
                    {{$item->asunto}}
                </td>
                <td class="px-6 py-4">
                    @switch($item->estado)
                    @case('por definir')
                    <span class="bg-gray-100 text-gray-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-gray-300">{{$item->estado}}</span>
                    @break
                    @case('atendido')
                    <span class="bg-green-100 text-green-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">{{$item->estado}}</span>
                    @break
                    @case('derivado')
                    <span class="bg-yellow-100 text-yellow-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-yellow-900 dark:text-yellow-300">{{$item->estado}}</span>
                    @break
                    @case('rechazado')
                    <span class="bg-red-100 text-red-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-yellow-900 dark:text-yellow-300">{{$item->estado}}</span>
                    @break
                    @endswitch
                </td>
                <td class="px-6 py-4">
                    <a href="{{route('tramite.showRespuestaExpedienteRemitente',['expediente'=>$item])}}">
                        <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 16 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 17V2a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H3a2 2 0 0 0-2 2Zm0 0a2 2 0 0 0 2 2h12M5 15V1m8 18v-4" />
                        </svg>
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>

        @endif
    </table>
</div>


@endsection
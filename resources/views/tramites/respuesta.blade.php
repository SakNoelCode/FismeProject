@extends('layouts.tramite.app-tramite')

@section('title','Respuestas del expediente')

@section('content')

<section class="flex justify-end mb-3">
    <a href="{{route('tramite.showRespuestasExpedienteRemitente')}}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
        Volver
    </a>
</section>


@include('include.alert')

<!---Tabla de Historiales--->
<div class="relative overflow-x-auto shadow-md sm:rounded-lg">

    <table class="w-full text-xs text-left text-gray-500 dark:text-gray-400">
        <caption class="p-5 text-sm font-semibold text-left text-gray-900 bg-white dark:text-white dark:bg-gray-800">
            Respuestas del expediente
            <p class="mt-1 text-xs font-normal text-gray-500 dark:text-gray-400">
                En la siguiente tabla se muestra todo el registro de cambios por el que ha pasado el expediente y las respuestas.
            </p>
            @if ($expediente->historiales->isEmpty())
            <div class="px-6 py-4">
                <p class="text-center text-base text-gray-900 dark:text-white">No hay registros</p>
            </div>
        </caption>
        @else

        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Fecha y Hora
                </th>
                <th scope="col" class="px-6 py-3">
                    Descripción
                </th>
                <th scope="col" class="px-6 py-3">
                    Documento adjunto
                </th>
                <th scope="col" class="px-6 py-3">
                    Encargado
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($expediente->historiales as $item)
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                <th class="px-6 py-4">
                    {{date("d/m/Y", strtotime($item->fecha_hora))}} - {{date("H.i", strtotime($item->fecha_hora))}}
                </th>
                <td class="px-6 py-4">
                    {{$item->descripcion}}
                </td>
                <td class="px-6 py-4">
                    @if ($item->documento_adjunto)
                    <a target="_blank" href="{{route('tramite.verPdfExpediente',['name'=>$item->documento_adjunto])}}">
                        <svg class="w-[20px] h-[20px] text-blue-600 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 14">
                            <g stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                                <path d="M10 10a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" />
                                <path d="M10 13c4.97 0 9-2.686 9-6s-4.03-6-9-6-9 2.686-9 6 4.03 6 9 6Z" />
                            </g>
                        </svg>
                    </a>
                    @else
                    No hay documento
                    @endif
                </td>
                <td class="px-6 py-4">
                    {{$item->user->name}}
                </td>
            </tr>
            @endforeach
        </tbody>

        @endif
    </table>
</div>


@endsection
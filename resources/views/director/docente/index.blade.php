<x-app-layout>
    <x-slot name="header">
        <!-- Breadcrumb -->
        <nav class="flex" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                    <a href="{{route('dashboard')}}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white">
                        <svg class="w-3 h-3 mr-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z" />
                        </svg>
                        Inicio
                    </a>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <svg class="w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4" />
                        </svg>
                        <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2 dark:text-gray-400">Docentes</span>
                    </div>
                </li>
            </ol>
        </nav>
    </x-slot>
    <div class="py-8">
    <div class="mx-auto sm:px-4" >
        <div>
            <a href="{{route('docentes.create')}}" class="text-white bg-gradient-to-r from-green-400 via-blue-500 to-blue-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-600 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">Registrar Nuevo Docente</a>
        </div>
        <div class="mb-4"><br>
            <div class="mb-4">
                <h1><strong style="color: blue">FORMULARIO DE DOCENTES</strong></h1>
            </div>
        </div>        
        <table class="border-separate border-spacing-2 border border-slate-400 table w-full rounded-2xl">
            <thead>
              <tr class="">
                <th class="w-1/">#</th>
                <th class="w-1/">APELLIDOS</th>
                <th class="w-1/">NOMBRE</th>
                <th class="w-1/">EMAIL</th>
                <th class="w-1/">TELÉFONO</th>
                <th class="w-1/">CARGO</th>
                <th class="w-1/">ACCIONES</th>
              </tr>
            </thead>
            <tbody class=" text-center">
                @foreach ($docentes as $docente)
                <tr class=" bg-emerald-500-600 cursor-pointer">
                    <td class="border border-slate-300">{{$docente->id}}</td>
                    <td class="border border-slate-300">{{$docente->apellidos}}</td>
                    <td class="border border-slate-300">{{$docente->nombres}}</td>
                    <td class="border border-slate-300">{{$docente->email}}</td>
                    <td class="border border-slate-300">{{$docente->telefono}}</td>
                    <td class="border border-slate-300">{{$docente->especialidad}}</td>
                    <td class="border border-slate-300">
                        <form action="{{ route('docentes.destroy',$docente->id) }}" method="POST">
                            <a href="/docentes/{{$docente->id}}/edit" class="bg-teal-400 rounded-xl px-2">Edit</a>
                            @csrf
                            @method('DELETE')
                            <BUtton type="submit" class="bg-red-600 rounded-lg px-2">Delete</BUtton>
                        </form>
                  </tr>
                @endforeach
            </tbody>
          </table>
   
</div>
</div>
</x-app-layout>
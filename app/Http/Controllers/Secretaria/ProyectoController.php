<?php

namespace App\Http\Controllers\Secretaria;

use App\Events\saveAsignarJuradoEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\saveAsignarJuradoRequest;
use App\Models\Asesor;
use App\Models\Proyecto;


class ProyectoController extends Controller
{
    public function showAsignarJurado(Proyecto $proyecto)
    {
        $docentes = Asesor::all();
        return view('secretaria.proyecto.asignar-jurado', compact('docentes', 'proyecto'));
    }

    public function saveAsignarJurado(saveAsignarJuradoRequest $request, Proyecto $proyecto)
    {

        saveAsignarJuradoEvent::dispatch($request->validated(), $proyecto);

        return redirect()->route('proyectos.index')->with('success', 'Jurado asignado');
    }
}

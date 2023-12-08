<?php

namespace App\Http\Controllers\Secretaria;

use App\Events\saveAsesorEvent;
use App\Events\saveAsignarJuradoEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\saveAsignarJuradoRequest;
use App\Http\Requests\storeAsesorRequest;
use App\Models\Asesor;
use App\Models\Escuela;
use App\Models\Proyecto;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class ProyectoController extends Controller
{
    public function showAsignarJurado(Proyecto $proyecto): View
    {
        $docentes = Asesor::all();
        return view('secretaria.proyecto.asignar-jurado', compact('docentes', 'proyecto'));
    }

    public function saveAsignarJurado(saveAsignarJuradoRequest $request, Proyecto $proyecto): RedirectResponse
    {

        saveAsignarJuradoEvent::dispatch($request->validated(), $proyecto);

        return redirect()->route('proyectos.index')->with('success', 'Jurado asignado');
    }

    public function showCrearAsesor(): View
    {
        $escuelas = Escuela::all();
        return view('secretaria.proyecto.create-asesor', compact('escuelas'));
    }

    public function saveAsesor(storeAsesorRequest $request)
    {
        saveAsesorEvent::dispatch($request->validated());
        return redirect()->route('proyectos.index')->with('success', 'Asesor creado');;
    }
}

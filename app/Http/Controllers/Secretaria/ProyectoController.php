<?php

namespace App\Http\Controllers\Secretaria;

use App\Http\Controllers\Controller;
use App\Http\Requests\saveAsignarJuradoRequest;
use App\Models\Asesor;
use App\Models\Juradotesi;
use App\Models\Proyecto;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ProyectoController extends Controller
{
    public function showAsignarJurado(Proyecto $proyecto)
    {
        $docentes = Asesor::all();
        return view('secretaria.proyecto.asignar-jurado', compact('docentes', 'proyecto'));
    }

    public function saveAsignarJurado(saveAsignarJuradoRequest $request, Proyecto $proyecto)
    {
        try {
            if (!$proyecto->juradotesi_id) {
                $jurado = Juradotesi::create($request->validated());
                $proyecto->juradotesis()->associate($jurado)->save();
            } else {
                $proyecto->juradotesis()->update($request->validated());
            }
        } catch (Exception $e) {
            Log::error('error:' . $e->getMessage());
            throw $e;
        }

        return redirect()->route('proyectos.index')->with('success', 'Jurado asignado');
    }
}

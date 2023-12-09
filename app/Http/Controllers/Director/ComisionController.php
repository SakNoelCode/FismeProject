<?php

namespace App\Http\Controllers\Director;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateComisionRequest;
use App\Models\Asesor;
use App\Models\Comision;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;

class ComisionController extends Controller
{
    public function index(): View
    {
        $comision = Comision::latest()->first();

        $comisiones = Comision::all();
        return view('director.comision.index', compact('comision','comisiones'));
    }

    public function create(): View
    {
        $asesores = Asesor::all();
        return view('director.comision.create', compact('asesores'));
    }

    public function update(UpdateComisionRequest $request): RedirectResponse
    {
        try {
            Comision::create([
                'fecha_inicio' => $request->fecha_inicio,
                'fecha_fin' => $request->fecha_fin,
                'docente_1' => $request->asesores[0],
                'docente_2' => $request->asesores[1],
                'docente_3' => $request->asesores[2],
            ]);
        } catch (Exception $e) {
            throw $e;
        }

        return redirect()->route('director.comision.index')->with('success', 'Comisión asignada');
    }
}

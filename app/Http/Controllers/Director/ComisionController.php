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
        $comisiones = Comision::latest()->get();
        return view('director.comision.index', compact('comisiones'));
    }

    public function create(): View
    {
        $asesores = Asesor::all();
        return view('director.comision.create', compact('asesores'));
    }

    public function update(UpdateComisionRequest $request): RedirectResponse
    {
        try {
            $ultimaComision = Comision::latest()->first();
            if ($ultimaComision) {
                $ultimaComision->update(['estado' => 'inactivo']);
            }

            $comision = Comision::create([
                'fecha_inicio' => $request->fecha_inicio,
                'fecha_fin' => $request->fecha_fin,
            ]);

            $comision->asesores()->attach([
                $request->presidente => ['cargo' => 'Presidente'],
                $request->secretario => ['cargo' => 'Secretario'],
                $request->vocal => ['cargo' => 'Vocal'],
                $request->accesitario => ['cargo' => 'Accesitario']
            ]);
        } catch (Exception $e) {
            throw $e;
        }

        return redirect()->route('director.comision.index')->with('success', 'Comisión asignada');
    }
}

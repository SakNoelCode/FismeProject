<?php

namespace App\Http\Controllers\Practicante;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePracticanteRequest;
use App\Models\Asesor;
use App\Models\Escuela;
use App\Models\Practica;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PracticaController extends Controller
{
    public function showHome(): View
    {
        return view('practicante.home');
    }

    public function createPracticante(): View
    {
        $escuelas = Escuela::all();
        return view('practicante.create', compact('escuelas'));
    }

    public function storePracticante(StorePracticanteRequest $request): RedirectResponse
    {
        try {
            DB::beginTransaction();
            Auth::user()->practicante->update($request->validated());
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            dd($e);
        }

        return redirect()->route('practicante.createPracticante')->with('status', 'practicante.saved');
    }

    public function createPractica(): View
    {
        $asesores = Asesor::whereNull('comision_id')->get();
        return view('practicante.practica.create', compact('asesores'));
    }

    public function storePractica(Request $request)
    {
        $request->validate([
            'asesore_id' => 'required|exists:asesores,id'
        ]);

        try {
            DB::beginTransaction();
            if(Auth::user()->practicante->practica == null){
                $practica = Practica::create();
                Auth::user()->practicante->update([
                    'asesore_id' => $request->asesore_id,
                    'practica_id' => $practica->id
                ]);
            }else{
                Auth::user()->practicante->update([
                    'asesore_id' => $request->asesore_id
                ]);
            }
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            dd($e);
        }

        return redirect()->route('practicante.createPractica')->with('status','practica.saved');
    }
}

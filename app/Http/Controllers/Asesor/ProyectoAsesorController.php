<?php

namespace App\Http\Controllers\Asesor;

use App\Http\Controllers\Controller;
use App\Models\Asesor;
use App\Models\Estado;
use App\Models\Etapa;
use App\Models\Proyecto;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProyectoAsesorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('proyecto-search');


        if ($search === null) {
            $asesor = Asesor::where('user_id', Auth::id())->first();

            $proyectos = Proyecto::where('asesor_id', $asesor->id)
                ->paginate(5);
        } else {

            $asesor = Asesor::where('user_id', Auth::id())->first();

            $proyectos = Proyecto::with('asesor', 'tesista.user')
                ->where('proyectos.asesor_id', $asesor->id)
                ->Where(function ($query) use ($search) {
                    $query->where('proyectos.name', 'like', "%$search%")
                        ->orWhereHas('tesista.user', function ($subquery) use ($search) {
                            $subquery->where('name', 'like', "%$search%");
                        });
                })
                ->paginate(5);
        }


        return view('asesor.proyecto.index', compact('proyectos', 'search'));
    }

    public function verEstado(Proyecto $proyecto): View
    {
        $etapas = Etapa::all();
        $estados = Estado::all();
        return view('asesor.proyecto.ver-estado', compact('proyecto', 'etapas', 'estados'));
    }
}

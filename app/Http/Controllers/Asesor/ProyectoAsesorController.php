<?php

namespace App\Http\Controllers\Asesor;

use App\Http\Controllers\Controller;
use App\Models\Asesor;
use App\Models\Etapa;
use App\Models\Proyecto;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProyectoAsesorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $asesor = Asesor::where('user_id',Auth::id())->first();
        $proyectos = Proyecto::where('asesor_id',$asesor->id)
        ->paginate(5);


        return view('asesor.proyecto.index',compact('proyectos'));
    }

    public function verEstado(Proyecto $proyecto)
    {
        $etapas = Etapa::all();
        return view('asesor.proyecto.ver-estado', compact('proyecto', 'etapas'));
    }
}

<?php

namespace App\Http\Controllers\Tesista;

use App\Http\Controllers\Controller;
use App\Models\Etapa;
use App\Models\Proyecto;
use App\Models\Tesista;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ProyectoTesistaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $idTesista = Tesista::where('user_id',Auth::id())->first();
        $proyectos = Proyecto::where('tesista_id',$idTesista->id)->paginate(1);
        return view('tesista.proyecto.index',compact('proyectos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function verEstado(Proyecto $proyecto)
    {
        $etapas = Etapa::all();
        return view('tesista.proyecto.ver-estado', compact('proyecto', 'etapas'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Asesor;
use App\Models\Empresa;
use App\Models\Proyecto;
use App\Models\Tesista;
use Illuminate\Http\Request;

class ProyectoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('secretaria.proyecto.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tesistas = Tesista::all();
        $asesores = Asesor::all();
        $empresas = Empresa::all();
        return view('secretaria.proyecto.create',[
            'tesistas' => $tesistas,
            'asesores' => $asesores,
            'empresas' => $empresas
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255|unique:proyectos,name',
            'descripcion' => 'nullable|max:255',
            'tesista_id' => 'required|exists:tesistas,id',
            'asesor_id' => 'required|exists:asesores,id',
            'empresa_id' => 'required|exists:empresas,id'
        ]);

        $request->merge(['estado' => 'inicio']);

        Proyecto::create($request->all());

        return redirect()->route('proyectos.index')->with('success','Registro exitoso');
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
}

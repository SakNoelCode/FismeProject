<?php

namespace App\Http\Controllers;

use App\Models\Docente;
use App\Models\Practicante;
use Illuminate\Http\Request;

class PracticanteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $practicantes = Practicante::all();
        return view('practicante.index')->with('practicantes', $practicantes);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $docentes = Docente::all();
        return view('practicante.create', compact('docentes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $practicante = new Practicante();
        $practicante->fecha = $request->get('fecha');
        $practicante->tramite = $request->get('tramite');
        $practicante-> dirigido = $request->get('dirigido');
        $practicante->codigo = $request->get('codigo');
        $practicante->apellidos = $request->get('apellidos');
        $practicante->nombres = $request->get('nombres');
        $practicante->facultad = $request->get('facultad');
        $practicante->escuela = $request->get('escuela');
        $practicante->email = $request->get('email');
        $practicante->telefono = $request->get('telefono');
        $practicante->direccion = $request->get('direccion');

        $practicante->docente_id = $request->get('docente_id');
        $docente = Docente::find($request->input('docente_id'));
        $practicante->docente = $docente->nombres. ' ' .$docente->apellidos;

        $practicante->fundamentacion = $request->get('fundamentacion');

        if ($request->hasFile('pdf')) {
            $archivo = $request->file('pdf');
            $archivo->move(public_path().'/archivos/', $archivo->getClientOriginalName());
            $practicante->archivo = $archivo->getClientOriginalName();
        }
        
        $practicante->folios = $request->get('folios');
        $practicante->save();

        return redirect('/practicantes');
    }

    /**
     * Display the specified resource.
     */
    public function show(Practicante $practicante)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $practicante = Practicante::find($id);
        $docentes = Docente::all();
        return view('practicante.edit', compact('practicante','docentes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Practicante $practicante)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Practicante $practicante)
    {
        //
    }
}

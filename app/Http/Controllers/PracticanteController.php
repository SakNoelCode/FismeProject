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
        $practicantes = new Practicante();
        $practicantes->fecha = $request->get('fecha');
        $practicantes->tramite = $request->get('tramite');
        $practicantes-> dirigido = $request->get('dirigido');
        $practicantes->codigo = $request->get('codigo');
        $practicantes->apellidos = $request->get('apellidos');
        $practicantes->nombres = $request->get('nombres');
        $practicantes->facultad = $request->get('facultad');
        $practicantes->escuela = $request->get('escuela');
        $practicantes->email = $request->get('email');
        $practicantes->telefono = $request->get('telefono');
        $practicantes->direccion = $request->get('direccion');

        $practicantes->docente_id = $request->get('docente_id');
        $docente = Docente::find($request->input('docente_id'));
        $practicantes->docente = $docente->nombres. ' ' .$docente->apellidos;

        $practicantes->fundamentacion = $request->get('fundamentacion');

        if ($request->hasFile('pdf')) {
            $archivo = $request->file('pdf');
            $archivo->move(public_path().'/archivos/', $archivo->getClientOriginalName());
            $practicantes->archivo = $archivo->getClientOriginalName();
        }
        
        $practicantes->folios = $request->get('folios');
        $practicantes->save();

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
    public function update(Request $request,$id)
    {
        $practicante = Practicante::find($id);
        $practicante->fecha = $request->get('fecha');
        $practicante->fecha_sustentacion = $request->get('fecha_sustentacion');
        $practicante->hora_sustentacion = $request->get('hora_sustentacion');
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
        if($docente) {
            $practicante->docente = $docente->nombres. ' ' .$docente->apellidos;
        } else {
            // Manejo del caso en el que no se encuentra el docente
        }
        // $practicante->docente = $docente->nombres. ' ' .$docente->apellidos;

        $practicante->fundamentacion = $request->get('fundamentacion');

        if ($request->hasFile('pdf')) {
            $archivo = $request->file('pdf');
            $archivo->move(public_path().'/archivos/', $archivo->getClientOriginalName());
            $practicante->archivo = $archivo->getClientOriginalName();
        }
        
        $practicante->folios = $request->get('folios');
        $practicante->etapa = $request->get('etapa');
        $practicante->estado = $request->get('estado');

        if ($request->hasFile('resolucion')) {
            $resolucion = $request->file('resolucion');
            $resolucion->move(public_path().'/archivos/', $resolucion->getClientOriginalName());
            $practicante->resolucion = $resolucion->getClientOriginalName();
        }
        $practicante->save();

        return redirect('/practicantes');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Practicante $practicante)
    {
        //
    }
}

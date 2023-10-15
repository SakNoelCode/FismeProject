<?php

namespace App\Http\Controllers;

use App\Models\Acta;
use App\Models\Docente;
use App\Models\Practicante;
use Illuminate\Http\Request;

use function Pest\Laravel\delete;

class ActaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $actas = Acta::all();
        return view('actas.index')->with('actas', $actas);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $practicantes = Practicante::all();
        return view('actas.create', compact('practicantes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $actas = new Acta();
        $actas->titulo = $request->get('titulo');
        $actas->fecha = $request->get('fecha');
        $actas->estado = $request->get('estado');
        $actas->observaciones = $request->get('observaciones');
        if ($request->hasFile('pdf')) {
            $archivo = $request->file('pdf');
            $archivo->move(public_path().'/archivos/', $archivo->getClientOriginalName());
            $actas->archivo = $archivo->getClientOriginalName();
        }

        $actas->practicante_id = $request->get('practicante_id');
        $practicante = Practicante::find($request->input('practicante_id'));
        $actas->nombre = $practicante->nombres. ' ' .$practicante->apellidos;

        
        $actas->save();
        return redirect('/actas');
    }

    /**
     * Display the specified resource.
     */
    public function show(Acta $acta)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit( $id)
    {
        //
        $practicantes = Practicante::all();
        $acta = Acta::find($id);
        return view('actas.edit', compact('practicantes', 'acta'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
        $acta = Acta::find($id);
        $acta->titulo = $request->get('titulo');
        $acta->fecha = $request->get('fecha');
        $acta->estado = $request->get('estado');
        $acta->observaciones = $request->get('observaciones');
        if ($request->hasFile('pdf')) {
            $archivo = $request->file('pdf');
            $archivo->move(public_path().'/archivos/', $archivo->getClientOriginalName());
            $acta->archivo = $archivo->getClientOriginalName();
        }

        $acta->practicante_id = $request->get('practicante_id');
        $practicante = Practicante::find($request->input('practicante_id'));
        $acta->nombre = $practicante->nombres. ' ' .$practicante->apellidos;

        
        $acta->save();
        return redirect('/actas');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
        //
        $acta = Acta::find($id);
        $acta->delete();
        return redirect('/actas');
    }
}

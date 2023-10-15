<?php

namespace App\Http\Controllers;

use App\Models\Docente;
use Illuminate\Http\Request;

class DocenteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $docentes = Docente::all();
        return view('director.docente.index')->with('docentes',$docentes);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('director.docente.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $docentes = new Docente();
        $docentes->apellidos = $request->get('apellidos');
        $docentes->nombres = $request->get('nombres');
        $docentes->email = $request->get('email');
        $docentes->telefono = $request->get('telefono');
        $docentes->especialidad = $request->get('especialidad');
        $docentes->save();
        return redirect('/docentes');
    }

    /**
     * Display the specified resource.
     */
    public function show(Docente $docente)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit( $id)
    {
        //
        $docente = Docente::find($id);
        return view('director.docente.edit')->with('docente',$docente);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        //
        $docente = Docente::find($id);
        $docente->apellidos = $request->get('apellidos');
        $docente->nombres = $request->get('nombres');
        $docente->email = $request->get('email');
        $docente->telefono = $request->get('telefono');
        $docente->especialidad = $request->get('especialidad');
        $docente->save();
        return redirect('/docentes');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $docente = Docente::find($id);
        $docente->delete();
        return redirect('/docentes');

    }
}

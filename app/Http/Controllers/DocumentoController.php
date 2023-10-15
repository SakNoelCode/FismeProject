<?php

namespace App\Http\Controllers;

use App\Mail\DocumentoMail;
use App\Models\Docente;
use App\Models\Practicante;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class DocumentoController extends Controller
{
    //
    public function create(){
        $docentes = Docente::all();
        return view('practicante.create', compact('docentes'));
    }

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

        return redirect()->route('solicitud-practicas')->with('success', 'Registro exitoso!');
    }

    public function enviarEmail(string $practicantes, string $archivo){
        Mail::to('perezeusebiodavila@gmail.com')->send(new DocumentoMail($practicantes, $archivo));
        return redirect()->back();
    }

}

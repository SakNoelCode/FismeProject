<?php

namespace App\Http\Controllers\Secretaria;

use App\Http\Controllers\Controller;
use App\Models\Acta;
use App\Models\Practica;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\File;

class PracticaController extends Controller
{
    public function index(): View
    {
        $practicas = Practica::orderBy('created_at', 'desc')->paginate(5);
        return view('secretaria.practica.index', compact('practicas'));
    }

    public function verPDF(String $name)
    {
        $filePath = 'actas/' . $name;


        if (Storage::disk('public')->exists($filePath)) {

            $pdfPath = Storage::disk('public')->path($filePath);

            return response()->file($pdfPath);
        } else {
            return redirect()->back()->withErrors(['El archivo PDF no existe.']);
        }
    }

    public function updateSustentacion(Request $request, Practica $practica): RedirectResponse
    {
        $request->validate([
            'fecha_sustentacion' => 'required|date',
            'hora_sustentacion' => 'required'
        ]);

        $fechaSustentacion = $request->fecha_sustentacion . ' ' . $request->hora_sustentacion;

        $practica->update(['fecha_sustentacion' => $fechaSustentacion]);

        return redirect()->route('secretaria.practicas.index')->with('success', 'Fecha y hora asignada');
    }

    public function updateEstado(Request $request, Practica $practica)
    {
        $request->validate([
            'estado' => 'required'
        ]);
        $practica->update($request->all());
        return redirect()->route('secretaria.practicas.index')->with('success', 'Estado actualizado');
    }

    public function updateEtapa(Request $request, Practica $practica)
    {
        $request->validate([
            'etapa' => 'required'
        ]);
        $practica->update($request->all());
        return redirect()->route('secretaria.practicas.index')->with('success', 'Etapa actualizada');
    }

    public function loadFilePractica(Request $request, Practica $practica)
    {
        $request->validate([
            'documento_path' => ['required', File::types(['pdf'])]
        ]);

        if ($request->hasFile('documento_path')) {
            //Comprobar si existe un archivo ya cargado
            $documentoExistente = Acta::where('practica_id', $practica->id)
                ->where('tipoacta_id', 6)
                ->first();

            if ($documentoExistente) {
                Storage::delete('actas/' . $documentoExistente->documento_path);

                $file = $request->file('documento_path');
                $nameDocumento = (new Acta())->guardarDocumento($file);

                $documentoExistente->update([
                    'documento_path' => $nameDocumento,
                ]);

                //Si no existe
            } else {
                $file = $request->file('documento_path');
                $nameDocumento = (new Acta())->guardarDocumento($file);

                Acta::create([
                    'documento_path' => $nameDocumento,
                    'tipoacta_id' => 6,
                    'practica_id' => $practica->id
                ]);
            }
        }

        return redirect()->route('secretaria.practicas.index')->with('success', 'Resolución subida');
    }

    public function storeInformeFinalPractica(Request $request, Practica $practica)
    {
        $request->validate([
            'documento_path' => ['required', File::types(['pdf'])]
        ]);

        if ($request->hasFile('documento_path')) {
            //Comprobar si existe un archivo ya cargado
            $documentoExistente = Acta::where('practica_id', $practica->id)
                ->where('tipoacta_id', 8)
                ->first();

            if ($documentoExistente) {
                Storage::delete('actas/' . $documentoExistente->documento_path);

                $file = $request->file('documento_path');
                $nameDocumento = (new Acta())->guardarDocumento($file);

                $documentoExistente->update([
                    'documento_path' => $nameDocumento,
                ]);

                //Si no existe
            } else {
                $file = $request->file('documento_path');
                $nameDocumento = (new Acta())->guardarDocumento($file);

                Acta::create([
                    'documento_path' => $nameDocumento,
                    'tipoacta_id' => 8,
                    'practica_id' => $practica->id
                ]);
            }
        }

        return redirect()->route('secretaria.practicas.index')->with('success', 'Resolución subida');
    }

    public function uploadCargo(Request $request, Practica $practica, String $id)
    {
        $request->validate([
            'cargo_path' => ['required', File::types(['pdf'])]
        ]);

        if ($request->hasFile('cargo_path')) {
            //Comprobar si existe un archivo ya cargado
            $documentoExistente = Acta::where('practica_id', $practica->id)
                ->where('id', $id)
                ->where('cargo_path', '<>', null)
                ->first();

            if ($documentoExistente) {
                Storage::delete('actas/' . $documentoExistente->cargo_path);

                $file = $request->file('cargo_path');
                $nameDocumento = (new Acta())->guardarDocumento($file);
                Acta::where('practica_id', $practica->id)
                    ->where('id', $id)
                    ->update([
                        'cargo_path' => $nameDocumento
                    ]);

                //Si no existe
            } else {
                $file = $request->file('cargo_path');
                $nameDocumento = (new Acta())->guardarDocumento($file);
                Acta::where('practica_id', $practica->id)
                    ->where('id', $id)
                    ->update([
                        'cargo_path' => $nameDocumento
                    ]);
            }
        }

        return redirect()->route('secretaria.practicas.index')->with('success', 'Cargo subido');
    }

    public function crearProveidoSolicitud(Request $request, Practica $practica, String $id)
    {
        $request->validate([
            'pase' => 'required|max:200',
            'para' => 'required|max:200'
        ]);

        $request->merge([
            'pase_proveido' => $request->pase,
            'para_proveido' => $request->para,
            'fecha_proveido' => Carbon::now()->toDateString(),
        ]);

        $acta = Acta::where('practica_id', $practica->id)
            ->where('id', $id)
            ->first();

        $acta->update($request->all());

        return redirect()->route('secretaria.practicas.index')->with('success', 'Derivación exitosa');
    }
}

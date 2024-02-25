<?php

namespace App\Http\Controllers\Practicante;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePracticanteRequest;
use App\Models\Acta;
use App\Models\Asesor;
use App\Models\Escuela;
use App\Models\Practica;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\File;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Illuminate\Support\Facades\Response;

class PracticaController extends Controller
{
    public function showHome(): View
    {
        /*  dd($existeActaConId6 = Auth::user()
            ->practicante
            ->practica
            ->actas()
            ->where('tipoacta_id', 6)
            ->exists());*/
        // dd($acta = Auth::user()->practicante->practica->actas->firstWhere('tipoacta_id', 6));
        return view('practicante.home');
    }

    public function createPracticante(): View
    {
        $escuelas = Escuela::all();
        return view('practicante.create', compact('escuelas'));
    }

    public function storePracticante(StorePracticanteRequest $request): RedirectResponse
    {
        try {
            DB::beginTransaction();
            Auth::user()->practicante->update($request->validated());
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            dd($e);
        }

        return redirect()->route('practicante.createPracticante')->with('status', 'practicante.saved');
    }

    public function createPractica(): View
    {
        $asesores = Asesor::all();
        return view('practicante.practica.create', compact('asesores'));
    }

    public function storePractica(Request $request)
    {
        $request->validate([
            'asesore_id' => 'required|exists:asesores,id'
        ]);

        try {
            DB::beginTransaction();
            if (Auth::user()->practicante->practica == null) {
                $practica = Practica::create();
                Auth::user()->practicante->update([
                    'asesore_id' => $request->asesore_id,
                    'practica_id' => $practica->id
                ]);
            } else {
                Auth::user()->practicante->update([
                    'asesore_id' => $request->asesore_id
                ]);
            }
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            dd($e);
        }

        return redirect()->route('practicante.createPractica')->with('status', 'practica.saved');
    }

    public function createActas()
    {
        $acta1 = Acta::where('practica_id', Auth::user()->practicante->practica->id)
            ->where('tipoacta_id', 1)
            ->first();

        $acta2 = Acta::where('practica_id', Auth::user()->practicante->practica->id)
            ->where('tipoacta_id', 2)
            ->first();

        $acta3 = Acta::where('practica_id', Auth::user()->practicante->practica->id)
            ->where('tipoacta_id', 3)
            ->first();

        $acta4 = Acta::where('practica_id', Auth::user()->practicante->practica->id)
            ->where('tipoacta_id', 4)
            ->first();

        $acta5 = Acta::where('practica_id', Auth::user()->practicante->practica->id)
            ->where('tipoacta_id', 5)
            ->first();

        return view('practicante.actas.create', compact('acta1', 'acta2', 'acta3', 'acta4', 'acta5'));
    }

    public function storeActas(Request $request)
    {
        $request->validate([
            'tipo' => 'required',
            'documento_path' => ['required', File::types(['pdf'])]
        ]);

        $message = '';

        try {
            DB::beginTransaction();

            switch ($request->tipo) {
                case 1:
                    //Save Acta
                    if ($request->hasFile('documento_path')) {

                        //Comprobar si existe un archivo ya cargado
                        $documentoExistente = Acta::where('practica_id', Auth::user()->practicante->practica->id)
                            ->where('tipoacta_id', 1)
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
                                'tipoacta_id' => $request->tipo,
                                'practica_id' => Auth::user()->practicante->practica->id
                            ]);
                        }
                    }

                    $message = 'acta1.saved';

                    break;
                case 2:

                    //Save Acta
                    if ($request->hasFile('documento_path')) {

                        //Comprobar si existe un archivo ya cargado
                        $documentoExistente = Acta::where('practica_id', Auth::user()->practicante->practica->id)
                            ->where('tipoacta_id', 2)
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
                                'tipoacta_id' => $request->tipo,
                                'practica_id' => Auth::user()->practicante->practica->id
                            ]);
                        }
                    }

                    $message = 'acta2.saved';
                    break;
                case 3:

                    //Save Acta
                    if ($request->hasFile('documento_path')) {

                        //Comprobar si existe un archivo ya cargado
                        $documentoExistente = Acta::where('practica_id', Auth::user()->practicante->practica->id)
                            ->where('tipoacta_id', 3)
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
                                'tipoacta_id' => $request->tipo,
                                'practica_id' => Auth::user()->practicante->practica->id
                            ]);
                        }
                    }

                    $message = 'acta3.saved';
                    break;
                case 4:

                    //Save Acta
                    if ($request->hasFile('documento_path')) {

                        //Comprobar si existe un archivo ya cargado
                        $documentoExistente = Acta::where('practica_id', Auth::user()->practicante->practica->id)
                            ->where('tipoacta_id', 4)
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
                                'tipoacta_id' => $request->tipo,
                                'practica_id' => Auth::user()->practicante->practica->id
                            ]);
                        }
                    }

                    $message = 'acta4.saved';
                    break;
                case 5:

                    //Save Acta
                    if ($request->hasFile('documento_path')) {

                        //Comprobar si existe un archivo ya cargado
                        $documentoExistente = Acta::where('practica_id', Auth::user()->practicante->practica->id)
                            ->where('tipoacta_id', 5)
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
                                'tipoacta_id' => $request->tipo,
                                'practica_id' => Auth::user()->practicante->practica->id
                            ]);
                        }
                    }

                    $message = 'acta5.saved';
                    break;
            }

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            dd($e);
        }

        return redirect()->route('practicante.createActas')->with('status', $message);
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

    
    public function generateSolicitudAprobacionPractica()
    {
        return view('practicante.actas.generate-solicitud-practica');
    }

    public function generateSolicitudAprobacionPracticaPDF(Request $request)
    {
        $request->validate([
            'nameDecano' => 'required',
            'direccion' => 'required',
            'year' => 'required'
        ]);


        $data = [
            'nameDecano' => $request->nameDecano,
            'razon_social' => Auth::user()->practicante->razon_social,
            'dni' => substr(Auth::user()->practicante->codigo_estudiante, 0, -2),
            'codigo' => Auth::user()->practicante->codigo_estudiante,
            'direccion' => $request->direccion,
            'celular' => Auth::user()->practicante->telefono,
            'name_year' => $request->year
        ];

        // Crear el objeto PDF y cargar la vista
        $pdf = PDF::loadView('reportes.solicitud-aprobacion-practica', $data);

        return $pdf->stream('solicitud.pdf');
    }

    public function createInformeFinal(): View
    {
        return view('practicante.create-informe-final');
    }

    public function storeInformeFinal(Request $request)
    {
        $request->validate([
            'documento_path' =>  ['required', File::types(['pdf'])]
        ]);

        if ($request->hasFile('documento_path')) {

            //Comprobar si existe un archivo ya cargado
            $existe = Auth::user()->practicante->practica->path_informe_final;

            if ($existe) {
                Storage::delete('informes/' . $existe);
            }

            $file = $request->file('documento_path');
            $nameDocumento = (new Practica())->guardarDocumento($file);
            Auth::user()->practicante->practica->update([
                'path_informe_final' => $nameDocumento,
            ]);
        }

        return redirect()->route('practicante.create-informe-final')->with('status', 'saved');
    }

    public function verPDFInforme(String $name)
    {
        $filePath = 'informes/' . $name;


        if (Storage::disk('public')->exists($filePath)) {

            $pdfPath = Storage::disk('public')->path($filePath);

            return response()->file($pdfPath);
        } else {
            return redirect()->back()->withErrors(['El archivo PDF no existe.']);
        }
    }

    public function verPDFDesignacionJurado(String $name)
    {
        $filePath = 'actas/' . $name;


        if (Storage::disk('public')->exists($filePath)) {

            $pdfPath = Storage::disk('public')->path($filePath);

            return response()->file($pdfPath);
        } else {
            return redirect()->back()->withErrors(['El archivo PDF no existe.']);
        }
    }

    public function vistaGenerarSolicitudDesignacionJurado()
    {
        return view('practicante.generar.generar-solicitud');
    }

    public function generarSolicitudDesignacionJurado(Request $request)
    {
        $request->validate([
            'nameDirector' => 'required',
            'direccion' => 'required',
            'year' => 'required'
        ]);

        $data = [
            'name_year' => $request->year,
            'nameDirector' => $request->nameDirector,
            'razon_social' => Auth::user()->practicante->razon_social,
            'dni' => substr(Auth::user()->practicante->codigo_estudiante, 0, -2),
            'codigo' => Auth::user()->practicante->codigo_estudiante,
            'direccion' => $request->direccion,
            'celular' => Auth::user()->practicante->telefono
        ];

        // Crear el objeto PDF y cargar la vista
        $pdf = PDF::loadView('reportes.designacion-jurado', $data);

        return $pdf->stream('designacion_jurado.pdf');
    }

    public function storeDesignacionJurado(Request $request)
    {
        $request->validate([
            'documento_path' =>  ['required', File::types(['pdf'])]
        ]);


        //Save Acta
        if ($request->hasFile('documento_path')) {

            //Comprobar si existe un archivo ya cargado
            $documentoExistente = Acta::where('practica_id', Auth::user()->practicante->practica->id)
                ->where('tipoacta_id', 7)
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
                    'tipoacta_id' => $request->tipo,
                    'practica_id' => Auth::user()->practicante->practica->id
                ]);
            }
        }


        /*
        if ($request->hasFile('documento_path')) {

            //Comprobar si existe un archivo ya cargado
            $existe = Auth::user()->practicante->practica->path_designacion_jurado;

            if ($existe) {
                Storage::delete('informes/' . $existe);
            }

            $file = $request->file('documento_path');
            $nameDocumento = (new Practica())->guardarDocumento($file);
            Auth::user()->practicante->practica->update([
                'path_designacion_jurado' => $nameDocumento,
            ]);
        }*/

        return redirect()->route('practicante.create-informe-final')->with('status', 'savedDesignacion');
    }
}

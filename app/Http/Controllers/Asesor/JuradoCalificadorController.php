<?php

namespace App\Http\Controllers\Asesor;

use App\Http\Controllers\Controller;
use App\Models\Practica;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class JuradoCalificadorController extends Controller
{
    public function index(): View
    {
        $asesore_id = Auth::user()->asesor->id;

        $practicas =  Practica::leftJoin('asesores as presidente', 'practicas.presidente_id', '=', 'presidente.id')
            ->leftJoin('asesores as secretario', 'practicas.secretario_id', '=', 'secretario.id')
            ->leftJoin('asesores as vocal', 'practicas.vocal_id', '=', 'vocal.id')
            ->leftJoin('asesores as accesitario', 'practicas.accesitario_id', '=', 'accesitario.id')
            ->leftJoin('users as UserPresidente', 'UserPresidente.id', '=', 'presidente.user_id')
            ->leftJoin('users as UserSecretario', 'UserSecretario.id', '=', 'secretario.user_id')
            ->leftJoin('users as UserVocal', 'UserVocal.id', '=', 'vocal.user_id')
            ->leftJoin('users as UserAccesitario', 'UserAccesitario.id', '=', 'accesitario.user_id')
            ->join('practicantes', 'practicantes.practica_id', '=', 'practicas.id')
            ->select(
                'practicas.id as id',
                'practicas.fecha_sustentacion_final as fecha_sustentacion_final',
                'practicantes.razon_social as razon_social',
                'practicas.path_informe_final as path_informe_final',
                'practicas.path_acta_sustentacion as path_acta_sustentacion',
                'UserPresidente.name as Presidente',
                'UserSecretario.name as Secretario',
                'UserVocal.name as Vocal',
                'UserAccesitario.name as Accesitario'
            )
            ->whereNotNull('path_informe_final')
            ->where('accesitario_id', $asesore_id)
            ->orWhere('vocal_id', $asesore_id)
            ->orWhere('secretario_id', $asesore_id)
            ->orWhere('presidente_id', $asesore_id)
            ->get();

        return view('asesor.jurado.index', compact('practicas'));
    }

    public function verPDFInforme(String $name): RedirectResponse|BinaryFileResponse
    {
        $filePath = 'informes/' . $name;

        if (Storage::disk('public')->exists($filePath)) {

            $pdfPath = Storage::disk('public')->path($filePath);

            return response()->file($pdfPath);
        } else {
            return redirect()->back()->withErrors(['El archivo PDF no existe.']);
        }
    }

    public function verPDF(String $name): RedirectResponse|BinaryFileResponse
    {
        $filePath = 'actas/' . $name;

        if (Storage::disk('public')->exists($filePath)) {

            $pdfPath = Storage::disk('public')->path($filePath);

            return response()->file($pdfPath);
        } else {
            return redirect()->back()->withErrors(['El archivo PDF no existe.']);
        }
    }

    /**
     * Función para actualizar la fecha de sustentación de la práctica
     */
    public function updateFechaSustentacionFinal(Request $request, String $id): RedirectResponse
    {
        $request->validate([
            'fecha_sustentacion' => 'required|date',
            'hora_sustentacion' => 'required'
        ]);

        $practica = Practica::find($id);

        $fechaSustentacion = $request->fecha_sustentacion . ' ' . $request->hora_sustentacion;

        $practica->update(['fecha_sustentacion_final' => $fechaSustentacion]);

        return redirect()->route('asesor.jurado.index')->with('success', 'Fecha y hora asignada');
    }

    /**
     * Subir el acta de sustentación de la práctca
     * 
     */
    public function storeActaSustentacion(Request $request, Practica $practica): RedirectResponse
    {
        $request->validate([
            'path_documento' => 'required|file'
        ]);

        if ($request->hasFile('path_documento')) {

            //Comprobar si existe un archivo ya cargado
            $existe = $practica->path_acta_sustentacion;

            if ($existe) {
                Storage::delete('actas/' . $existe);
            }

            $file = $request->file('path_documento');

            $path_file = (new Practica())->guardarActaSustentacion($file);

            try {
                $practica->update([
                    'path_acta_sustentacion' => $path_file
                ]);
            } catch (Exception $e) {
                dd($e);
            }
        }

        return redirect()->route('asesor.jurado.index')->with('success', 'Acta subida exitosamente');
    }
}

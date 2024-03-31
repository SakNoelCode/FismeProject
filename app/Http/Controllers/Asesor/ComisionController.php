<?php

namespace App\Http\Controllers\Asesor;

use App\Http\Controllers\Controller;
use App\Models\Comision;
use App\Models\Practica;
use App\Models\Practicante;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Exception;
use Illuminate\Database\Eloquent\Builder;

class ComisionController extends Controller
{
    /**
     * Mostrar la vista Index y mostrar todos los practicantes
     */
    public function index()
    {
        $practicantes = Practicante::with('practica.actas')
            ->latest()
            ->get();

        //dd($practicantes);
        return view('asesor.comision.index', compact('practicantes'));
    }

    /**
     * Función para visualizar PDF 
     */
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

    /**
     * Función para actualizar la fecha de sustentación de la práctica
     */
    public function updateFechaSustentacion(Request $request, String $id): RedirectResponse
    {
        $request->validate([
            'fecha_sustentacion' => 'required|date',
            'hora_sustentacion' => 'required'
        ]);

        $practica = Practica::whereHas('practicante', function ($query) use ($id) {
            $query->where('id', $id);
        })->first();

        $fechaSustentacion = $request->fecha_sustentacion . ' ' . $request->hora_sustentacion;

        $practica->update(['fecha_sustentacion' => $fechaSustentacion]);

        return redirect()->route('asesor.comision.index')->with('success', 'Fecha y hora asignada');
    }

    /**
     * Vista para generar el acta de aprobación de prácticas
     */
    public function generateActaSustentacionView(Practicante $practicante)
    {
        return view('asesor.comision.generar-acta-sustentacion', compact('practicante'));
    }

    /**
     * Generar el PDF de acta de siustentación
     */
    public function generateActaSustentacion(Request $request, Practicante $practicante)
    {
        $request->validate([
            'fecha' => 'required|date',
            'hora_inicio' => 'required',
            'hora_fin' => 'required',
            'titulo' => 'required',
            'nota_n' => 'required|numeric',
            'nota_l' => 'required',
            'observaciones' => 'nullable'
        ]);

        $presidente = User::whereHas('asesor', function (Builder $query) use ($practicante) {
            $query->where('id', $practicante->practica->presidente_id);
        })->first()->name;

        $secretario = User::whereHas('asesor', function (Builder $query) use ($practicante) {
            $query->where('id', $practicante->practica->secretario_id);
        })->first()->name;
        ;
        $vocal = User::whereHas('asesor', function (Builder $query) use ($practicante) {
            $query->where('id', $practicante->practica->vocal_id);
        })->first()->name;

        $data = [
            'fecha' => $request->fecha,
            'hora_inicio' => $request->hora_inicio,
            'hora_fin' => $request->hora_fin,
            'titulo' => $request->titulo,
            'presidente' => $presidente,
            'secretario' => $secretario,
            'vocal' => $vocal,
            'nota_n' => $request->nota_n,
            'nota_l' => $request->nota_l,
            'observaciones' => $request->observaciones ? $request->observaciones : ''

        ];

        // Crear el objeto PDF y cargar la vista
        $pdf = PDF::loadView('reportes.acta-sustentacion', $data);

        return $pdf->stream('actaSustentacion.pdf');
    }

    /**
     * Vista para generar el acta de revisión de prácticas
     */
    public function generateActaRevisionView(Practicante $practicante)
    {
        return view('asesor.comision.generar-acta-revision', compact('practicante'));
    }

    /**
     * Generar el PDF de acta de revisión
     */
    public function generateActaRevision(Request $request, Practicante $practicante)
    {
        $request->validate([
            'fecha' => 'required|date',
            'hora_inicio' => 'required',
            'hora_fin' => 'required',
            'numero' => 'required',
            'observaciones' => 'nullable'
        ]);

        $comision = Comision::with('asesores.user')->where('estado', 'activo')->first();
        $presidente = '';
        $secretario = '';
        $vocal = '';
        $is_aprobado = false;

        if ($request->has('is_aprobado')) {
            $is_aprobado = true;
        }

        foreach ($comision->asesores as $docente) {
            $cargo = $docente->pivot->cargo;
            $nombre = $docente->user->name;

            switch ($cargo) {
                case 'Presidente':
                    $presidente = $nombre;
                    break;
                case 'Secretario':
                    $secretario = $nombre;
                    break;
                case 'Vocal':
                    $vocal = $nombre;
                    break;
            }
        }

        $data = [
            'fecha' => $request->fecha,
            'numero' => $request->numero,
            'hora_inicio' => $request->hora_inicio,
            'hora_fin' => $request->hora_fin,
            'presidente' => $presidente,
            'secretario' => $secretario,
            'vocal' => $vocal,
            'nombre_practicante' => $practicante->razon_social,
            'observaciones' => $request->observaciones ? $request->observaciones : '',
            'aprobado' => $is_aprobado

        ];

        // Crear el objeto PDF y cargar la vista
        $pdf = PDF::loadView('reportes.acta-revision', $data);

        return $pdf->stream('actaRevision.pdf');
    }

    /**
     * Subir el acta de revisión de la práctca
     * 
     */
    public function subirActaRevision(Request $request, Practicante $practicante): RedirectResponse
    {
        $request->validate([
            'path_acta_revison' => 'required|file'
        ]);

        $file = $request->file('path_acta_revison');

        $path_file = (new Practica())->guardarActaRevision($file);

        try {
            $practicante->practica->update([
                'path_acta_revison' => $path_file
            ]);
        } catch (Exception $e) {
            dd($e);
        }

        return redirect()->route('asesor.comision.index')->with('success', 'Acta subida exitosamente');
    }


    /**
     * Ver el acta de revision
     */
    public function verActaRevision(Practica $practica)
    {
        $path = $practica->path_acta_revison;
        if (Storage::disk('public')->exists($path)) {
            $pdfPath = Storage::disk('public')->path($path);
            return response()->file($pdfPath);
        } else {
            return redirect()->back()->withErrors(['El archivo PDF no existe.']);
        }
    }
}

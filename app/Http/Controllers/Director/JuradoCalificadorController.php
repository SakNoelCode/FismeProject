<?php

namespace App\Http\Controllers\Director;

use App\Http\Controllers\Controller;
use App\Models\Asesor;
use App\Models\Practica;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class JuradoCalificadorController extends Controller
{
    public function index(): View
    {
        $practicantes = Practica::leftJoin('asesores as presidente', 'practicas.presidente_id', '=', 'presidente.id')
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
                'practicantes.razon_social as razon_social',
                'practicas.path_informe_final as path_informe_final',
                'UserPresidente.name as Presidente',
                'UserSecretario.name as Secretario',
                'UserVocal.name as Vocal',
                'UserAccesitario.name as Accesitario'
            )
            ->whereNotNull('path_informe_final')->get();

        return view('director.juradoCalificador.index', compact('practicantes'));
    }

    public function verPDF(String $name): BinaryFileResponse|RedirectResponse
    {
        $filePath = 'informes/' . $name;

        if (Storage::disk('public')->exists($filePath)) {

            $pdfPath = Storage::disk('public')->path($filePath);

            return response()->file($pdfPath);
        } else {
            return redirect()->back()->withErrors(['El archivo PDF no existe.']);
        }
    }

    public function create(Practica $practica): View
    {
        $asesores = Asesor::all();
        return view('director.juradoCalificador.create', compact('practica', 'asesores'));
    }

    public function update(Request $request, Practica $practica): RedirectResponse
    {
        $request->validate([
            'presidente' => 'required|numeric|different:secretario,vocal,accesitario',
            'secretario' => 'required|numeric|different:presidente,vocal,accesitario',
            'vocal' => 'required|numeric|different:presidente,secretario,accesitario',
            'accesitario' => 'required|numeric|different:presidente,secretario,vocal'
        ]);

        try {
            $practica->update([
                'presidente_id' => $request->presidente,
                'secretario_id' => $request->secretario,
                'vocal_id' => $request->vocal,
                'accesitario_id' => $request->accesitario,
            ]);
        } catch (Exception $e) {
            throw $e;
        }

        return redirect()->route('director.juradoCalificador.index')->with('success', 'Jurados asignados');
    }
}

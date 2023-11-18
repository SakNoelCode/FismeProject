<?php

namespace App\Http\Controllers\Tramite;

use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\Documento;
use App\Models\Expediente;
use App\Models\Remitente;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ExpedienteController extends Controller
{
    public function showHome()
    {
        return view('tramites.index');
    }

    public function createDatosRemitente()
    {
        return view('tramites.remitente');
    }

    public function storeDatosRemitente(Request $request)
    {
        $request->validate([
            'razon_social' => 'required|max:100',
            'tipo_documento' => 'required',
            'numero_documento' => 'required|max:45'
        ]);

        try {
            DB::beginTransaction();
            Auth::user()->remitente->update($request->all());
            DB::commit();
        } catch (Exception $e) {
            dd($e);
            DB::rollBack();
        }

        return redirect()->route('tramite.createDatosRemitente')->with('status', 'remitente.saved');
    }

    public function indexExpedienteRemitente()
    {
        $expedientes = Auth()->user()->remitente->expedientes;

        // dd($expedientes);
        return view('tramites.expediente', compact('expedientes'));
    }

    public function createExpedienteRemitente()
    {
        $areas = Area::all();
        return view('tramites.createExpediente', compact('areas'));
    }

    public function storeExpedienteRemitente(Request $request)
    {
        $request->validate([
            'asunto' => 'required|max:250',
            'tipo_documento' => 'required|max:20',
            'area_id' => 'required|integer|exists:areas,id',
            'documentos' => 'required'
        ]);


        $request->merge([
            'tipo' => 'externo',
        ]);

        $remitente = Remitente::find(Auth::user()->remitente->id);

        try {
            DB::beginTransaction();
            //Create expediente
            $expediente = $remitente->expedientes()->create($request->only(['tipo', 'asunto', 'tipo_documento', 'remitente_id', 'area_id']));

            //Create documentos
            if ($request->hasFile('documentos')) {
                $files = $request->file('documentos');

                foreach ($files as $file) {
                    $nameDocumento = (new Documento())->guardarDocumento($file);

                    Documento::create([
                        'nombre_path' => $nameDocumento,
                        'expediente_id' => $expediente->id,
                    ]);
                }
            }


            DB::commit();
        } catch (Exception $e) {
            dd($e);
            DB::rollBack();
        }

        return redirect()->route('tramite.indexExpedienteRemitente')->with('success', 'Expediente enviado');
    }

    public function verPDF(String $name)
    {
        $filePath = 'documentos/' . $name;


        if (Storage::disk('public')->exists($filePath)) {

            $pdfPath = Storage::disk('public')->path($filePath);

            return response()->file($pdfPath);
        } else {
            return redirect()->back()->withErrors(['El archivo PDF no existe.']);
        }
    }

    public function showRespuestasExpedienteRemitente()
    {
        $expedientes = Auth()->user()->remitente->expedientes;
        return view('tramites.respuestas',compact('expedientes'));
    }

    public function showRespuestaExpedienteRemitente(Expediente $expediente)
    {
        return view('tramites.respuesta',compact('expediente'));
    }
}

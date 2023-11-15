<?php

namespace App\Http\Controllers\Secretaria;

use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\Documento;
use App\Models\Expediente;
use App\Models\Secretaria;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ExpedienteController extends Controller
{

    public function index()
    {
        $area_id = Auth::user()->secretaria->area->id;

        if ($area_id == 4) {
            $expedientes = Expediente::latest()->with('documentos')->paginate(5);
        } else {
            $expedientes = Expediente::where('area_id', $area_id)->whereIn('estado',['proveido','archivado'])->paginate(5);
        }

        $areas = Area::all();
        $expedientesEnviados = Auth::user()->secretaria->expedientes;

        return view('secretaria.expediente.index', compact('expedientes', 'areas','expedientesEnviados'));
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

    public function atenderExpediente(Expediente $expediente)
    {
        return view('secretaria.expediente.atender', compact('expediente'));
    }

    public function addHistorialExpediente(Request $request, Expediente $expediente)
    {

        $request->validate([
            'descripcion' => 'required|max:255',
            'documento' => 'nullable|mimes:pdf'
        ]);


        $fecha_hora = Carbon::now()->toDateTimeString();
        $user_id = Auth::id();

        //Manejo del archivo
        if ($request->exists('documento')) {
            $uploadedFile = $request->file('documento');
            $uniqueFileName = uniqid() . '.' . $uploadedFile->getClientOriginalExtension();
            $uploadedFile->storeAs('documentos', $uniqueFileName);
        } else {
            $uniqueFileName = null;
        }

        $request->merge(['fecha_hora' => $fecha_hora, 'user_id' => $user_id, 'documento_adjunto' => $uniqueFileName]);


        try {
            DB::beginTransaction();
            $expediente->estado = 'archivado';
            $expediente->save();
            $expediente->historiales()->create($request->except('documento'));
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
        }

        return redirect()->route('secretaria.expedientes.index')->with('success', 'Expediente atendido');
    }

    public function cambiarEstadoExpediente(Request $request, String $id)
    {
        //dd($request->estado);
        $expediente = Expediente::find($id);
        try {
            DB::beginTransaction();
            $expediente->estado = $request->estado;
            $expediente->save();
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
        }

        return redirect()->route('secretaria.expedientes.index')->with('success', 'Estado actualizado');
    }

    public function derivarAreaExpediente(Request $request, String $id)
    {
        $area = Area::where('id', $request->area_id)->first();
        $expediente = Expediente::find($id);

        try {
            DB::beginTransaction();
            //Actualizar area del expediente
            $expediente->area_id = $request->area_id;
            $expediente->estado = 'proveido';
            $expediente->save();

            //Crear un historial
            $fecha_hora = Carbon::now()->toDateTimeString();
            $descripcion = Auth::user()->name . ' ha derivado el expediente al área de ' . $area->nombre;
            $user_id = Auth::id();

            $expediente->historiales()->create([
                'fecha_hora' => $fecha_hora,
                'descripcion' => $descripcion,
                'user_id' => $user_id
            ]);

            //Crear el proveido
            $expediente->proveidos()->create([
                'pase' => 'Secretaría',
                'para' => $area->nombre,
                'fecha' => Carbon::now()->toDateString()
            ]);

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
        }

        return redirect()->route('secretaria.expedientes.index')->with('success', 'Derivación exitosa');
    }

    public function enviarDocumento()
    {
        $areas = Area::all();
        return view('secretaria.expediente.enviar-documento', compact('areas'));
    }

    public function storeEnviarDocumento(Request $request)
    {
        $request->validate([
            'asunto' => 'required|max:50',
            'tipo_documento' => 'required|max:20',
            'area_id' => 'required|integer|exists:areas,id',
            'documentos' => 'required'
        ]);

        $request->merge([
            'tipo' => 'interno'
        ]);

        $secretaria = Secretaria::find(Auth::user()->secretaria->id);

        try {
            DB::beginTransaction();
            //Create expediente
            $expediente = $secretaria->expedientes()->create($request->only(['tipo', 'asunto', 'tipo_documento', 'remitente_id', 'area_id']));

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

        return redirect()->route('secretaria.expediente.enviarDocumento')->with('success', 'Expediente enviado');
    }
}

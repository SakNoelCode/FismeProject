<?php

namespace App\Http\Controllers\Secretaria;

use App\Events\enviarCorreoDocente;
use App\Http\Controllers\Controller;
use App\Mail\EnviarDocumentoDocenteMail;
use App\Models\Area;
use App\Models\Asesor;
use App\Models\Documento;
use App\Models\Expediente;
use App\Models\Remitente;
use App\Models\Secretaria;
use App\Models\Tipodocumento;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Illuminate\Support\Facades\Mail;

class ExpedienteController extends Controller
{

    public function index(Request $request)
    {
        $search = $request->search;
        $area_id = Auth::user()->secretaria->area->id;
        $areas = Area::all();
        $expedientesEnviados = Auth::user()->secretaria->expedientes;

        if ($search) {
            if ($area_id == 4) {
                $expedientes = Expediente::latest()
                    ->with('documentos')
                    ->where(function ($query) {
                        $query->where('tipo', 'externo')
                            ->Orwhere('expedientable_id', '!=', Auth::user()->secretaria->id);
                    })
                    ->where(function ($query) use ($search) {
                        $query->where('numeracion', 'like', '%' . $search . '%')
                            ->Orwhere(function ($query) use ($search) {
                                // Condición específica para el modelo Remitente
                                $query->whereHasMorph('expedientable', [Remitente::class], function ($q) use ($search) {
                                    $q->where('razon_social', 'like', '%' . $search . '%');
                                })
                                    // Condición específica para el modelo Secretaria
                                    ->orWhereHasMorph('expedientable', [Secretaria::class], function ($q) use ($search) {
                                        // Utiliza la relación para llegar al campo 'name' en el modelo 'User'
                                        $q->whereHas('user', function ($u) use ($search) {
                                            $u->where('name', 'like', '%' . $search . '%');
                                        });
                                    });
                            });
                    })
                    ->paginate(5);
                //dd($expedientes->expedientable);
            } else {
                $expedientes = Expediente::where('area_id', $area_id)
                    ->where(function ($query) use ($search) {
                        $query->where('numeracion', 'like', '%' . $search . '%')
                            ->Orwhere(function ($query) use ($search) {
                                // Condición específica para el modelo Remitente
                                $query->whereHasMorph('expedientable', [Remitente::class], function ($q) use ($search) {
                                    $q->where('razon_social', 'like', '%' . $search . '%');
                                })
                                    // Condición específica para el modelo Secretaria
                                    ->orWhereHasMorph('expedientable', [Secretaria::class], function ($q) use ($search) {
                                        // Utiliza la relación para llegar al campo 'name' en el modelo 'User'
                                        $q->whereHas('user', function ($u) use ($search) {
                                            $u->where('name', 'like', '%' . $search . '%');
                                        });
                                    });
                            });
                    })
                    ->whereIn('estado', ['derivado', 'atendido', 'rechazado'])
                    ->latest()
                    ->paginate(5);
            }
        } else {

            if ($area_id == 4) {
                $expedientes = Expediente::latest()
                    ->with('documentos')
                    ->where('tipo', 'externo')
                    ->Orwhere('expedientable_id', '!=', Auth::user()->secretaria->id)
                    ->paginate(5);
            } else {
                $expedientes = Expediente::where('area_id', $area_id)
                    ->whereIn('estado', ['derivado', 'atendido', 'rechazado'])
                    ->latest()
                    ->paginate(5);
            }
        }


        return view('secretaria.expediente.index', compact('expedientes', 'areas', 'expedientesEnviados', 'search'));
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
            $expediente->estado = 'atendido';
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
            $expediente->estado = 'derivado';
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
                'pase' => $area->nombre,
                'para' => $request->para,
                'fecha' => Carbon::now()->toDateTimeString()
            ]);

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
        }

        return redirect()->route('secretaria.expedientes.index')->with('success', 'Documento proveído');
    }

    public function enviarDocumento()
    {
        $tipodocumentos = Tipodocumento::all();
        $areas = Area::all();
        return view('secretaria.expediente.enviar-documento', compact('areas', 'tipodocumentos'));
    }

    public function storeEnviarDocumento(Request $request)
    {
        $request->validate([
            'asunto' => 'required|max:50',
            'tipodocumento_id' => 'required|integer|exists:tipodocumentos,id',
            'area_id' => 'required|integer|exists:areas,id',
            'documentos' => 'required'
        ]);

        $request->merge([
            'tipo' => 'interno',
            'estado' => 'derivado'
        ]);

        $secretaria = Secretaria::find(Auth::user()->secretaria->id);

        try {
            DB::beginTransaction();
            //Create expediente
            $expediente = $secretaria->expedientes()->create($request->only(['tipo', 'estado', 'asunto', 'tipodocumento_id', 'remitente_id', 'area_id']));

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

    public function enviarDocumentoDocente()
    {
        $tipodocumentos = Tipodocumento::all();
        $asesores = Asesor::all();
        return view('secretaria.expediente.enviar-documento-docente', compact('asesores', 'tipodocumentos'));
    }

    public function storeEnviarDocumentoDocente(Request $request)
    {
        $request->validate([
            'asunto' => 'required|max:50',
            'tipodocumento_id' => 'required|integer|exists:tipodocumentos,id',
            'documentos' => 'required',
            'asesores' => 'required|array'
        ]);

        $arrayDocumentos = array();
        if ($request->hasFile('documentos')) {
            $files = $request->file('documentos');

            foreach ($files as $file) {
                $nameDocumento = (new Documento())->guardarDocumento($file);
                $arrayDocumentos[] = $nameDocumento;
            }
        }

        /*foreach ($request->asesores as $asesor) {
            $asesor = Asesor::find($asesor);
            $documento = Tipodocumento::find($request->tipodocumento_id);
            //dd($asesor->user->name);

            $nameAsesor = $asesor->user->name;
            $emailAsesor = $asesor->user->email;
            $asunto = $request->asunto;
            $tipoDocumento = $documento->nombre;

            Mail::to($emailAsesor)->send(new EnviarDocumentoDocenteMail($nameAsesor, $asunto, $tipoDocumento, $arrayDocumentos));
        }*/

        enviarCorreoDocente::dispatch($request->asesores, $arrayDocumentos, $request->asunto, $request->tipodocumento_id);

        return redirect()->route('secretaria.expedientes.index')->with('success', 'Documento enviado');
    }

    public function archivarExpediente(Expediente $expediente)
    {
        $expediente->update([
            'estado' => 'atendido'
        ]);

        return back()->with('success', 'Expediente archivado');
    }

    public function registrarExpedienteFisico()
    {
        $tipodocumentos = Tipodocumento::all();
        //$areas = Area::all();
        return view('secretaria.expediente.registrar-expediente-fisico', compact('tipodocumentos'));
    }

    public function storeExpedienteFisico(Request $request)
    {
        $request->validate([
            'asunto' => 'required|max:250',
            'tipodocumento_id' => 'required|exists:tipodocumentos,id',
            'documentos' => 'required',
            'razon_social' => 'required|max:100',
            'tipo_documento' => [
                'required',
                Rule::in(['DNI', 'RUC']),
            ],
            'numero_documento' => [
                'required',
                function ($attribute, $value, $fail) use ($request) {
                    // Obtener el tipo de documento enviado en la solicitud
                    $tipoDocumento = $request->input('tipo_documento');

                    // Validar la longitud del número de documento según el tipo
                    if ($tipoDocumento == 'DNI' && strlen($value) != 8) {
                        $fail("El campo $attribute debe tener exactamente 8 dígitos para el tipo de documento DNI.");
                    } elseif ($tipoDocumento == 'RUC' && (strlen($value) < 11 || strlen($value) > 11)) {
                        $fail("El campo $attribute debe tener exactamente 11 dígitos para el tipo de documento RUC.");
                    }
                }
            ],

        ]);

        $request->merge(['tipo' => 'externo', 'user_id' => 4, 'area_id' => 4]);

        try {
            DB::beginTransaction();
            $remitente = Remitente::create($request->only('razon_social', 'tipo_documento', 'numero_documento'));

            $expediente = $remitente->expedientes()->create($request->only('tipo', 'asunto', 'area_id', 'tipodocumento_id', ''));

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

        return redirect()->route('secretaria.expedientes.index')->with('success', 'Documento fisico registrado');
    }

    public function filtrarExpedientes(Request $request)
    {
        $fecha_inicio = $request->fecha_inicio;
        $fecha_fin = $request->fecha_fin;

        if ($fecha_inicio && $fecha_fin) {

            $request->validate([
                'fecha_inicio' => 'required|date',
                'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
            ]);

            $fechaInicio = Carbon::parse($fecha_inicio)->startOfDay();
            $fechaFin = Carbon::parse($fecha_fin)->endOfDay();

            // Filtrar expedientes por rango de fechas
            $expedientes = Expediente::when($fechaInicio, function ($query) use ($fechaInicio) {
                return $query->where('created_at', '>=', $fechaInicio);
            })
                ->when($fechaFin, function ($query) use ($fechaFin) {
                    return $query->where('created_at', '<=', $fechaFin);
                })
                ->get();

            //dd($expedientes);

            return view('secretaria.expediente.filtrar', compact('fecha_inicio', 'fecha_fin', 'expedientes'));
        }

        return view('secretaria.expediente.filtrar');
    }

    public function downloadExpediente($fechainicio, $fechafin)
    {
        $fechaInicio = Carbon::parse($fechainicio)->startOfDay();
        $fechaFin = Carbon::parse($fechafin)->endOfDay();

        // Filtrar expedientes por rango de fechas
        $expedientes = Expediente::when($fechaInicio, function ($query) use ($fechaInicio) {
            return $query->where('created_at', '>=', $fechaInicio);
        })
            ->when($fechaFin, function ($query) use ($fechaFin) {
                return $query->where('created_at', '<=', $fechaFin);
            })
            ->get();
        //dd($expedientes);
        $pdf = PDF::loadview('reportes.expediente', ['expedientes' => $expedientes, 'fechaInicio' => $fechaInicio, 'fechaFin' => $fechaFin]);
        $pdf->setPaper('A4', 'landscape');
        return $pdf->stream('expedientes.pdf');
    }
}

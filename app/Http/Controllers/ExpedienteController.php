<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreExpedienteRequest;
use App\Models\Documento;
use App\Models\Expediente;
use App\Models\Remitente;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ExpedienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('expediente.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreExpedienteRequest $request)
    {
        //dd($request);

        //Generar la numeración para el expediente (Eso se gestiona el el modelo de manera automática)

        try{
            DB::beginTransaction();

            //Tabla remitente
            $remitente = Remitente::create($request->only('razon_social','numero_documento','email'));

            //Tabla documento
            $documento = new Documento();
            $nameDocumento = $documento->guardarDocumento($request->file('nombre_path'));
            $documento->fill([
                'descripcion' => $request->descripcion,
                'tipo' => $request->tipo,
                'nombre_path' => $nameDocumento
            ]);
            $documento->save();            

            //Tabla expediente
            $expediente = new Expediente();
            $codigo = $expediente->generateCodigoSeguridad();
            $fecha = $expediente->generateFecha();

            $expediente->fill([
                'codigo' => $codigo,
                'fecha_recepcion' => $fecha,
                'remitente_id' => $remitente->id,
                'documento_id' => $documento->id,
                'area_id' => 5 //Designar a mesa de partes por defecto
            ]);

            $expediente->save();                   

            DB::commit();
        }catch(Exception $e){
            DB::rollBack();
        }

        return redirect()->route('mesa-de-partes')->with('success','Trámite enviada exitosamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

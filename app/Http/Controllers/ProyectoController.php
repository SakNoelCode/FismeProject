<?php

namespace App\Http\Controllers;

use App\Models\Asesor;
use App\Models\Empresa;
use App\Models\Estado;
use App\Models\Etapa;
use App\Models\Proyecto;
use App\Models\Resolucion;
use App\Models\Tesista;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use PhpParser\Node\Expr\Cast\String_;

class ProyectoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search-proyecto');

        if ($search === null) {
            $proyectos = Proyecto::with('tesista.user', 'asesor.user', 'empresa', 'actividades')
                ->latest()
                ->paginate(5);
        } else {
            $proyectos = Proyecto::with('tesista.user', 'asesor.user', 'empresa', 'actividades')
                ->where('name', 'like', "%$search%")
                ->orWhere('descripcion', 'like', "%$search%")
                ->latest()
                ->paginate(5);
        }

        return view('secretaria.proyecto.index', compact('proyectos', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tesistas = Tesista::all();
        $asesores = Asesor::all();
        $empresas = Empresa::all();
        return view('secretaria.proyecto.create', [
            'tesistas' => $tesistas,
            'asesores' => $asesores,
            'empresas' => $empresas
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255|unique:proyectos,name',
            'descripcion' => 'nullable|max:255',
            'tesista_id' => 'required|exists:tesistas,id',
            'asesor_id' => 'required|exists:asesores,id',
            'empresa_id' => 'required|exists:empresas,id'
        ]);

        //$request->merge(['estado' => 'inicio']);

        Proyecto::create($request->all());

        return redirect()->route('proyectos.index')->with('success', 'Registro exitoso');
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
    public function edit(Proyecto $proyecto)
    {
        //$tesistas = Tesista::all();
        $asesores = Asesor::all();
        $empresas = Empresa::all();
        return view('secretaria.proyecto.edit', compact('proyecto', 'asesores', 'empresas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Proyecto $proyecto)
    {
        $request->validate([
            'name' => 'required|max:255|unique:proyectos,name,' . $proyecto->id,
            'descripcion' => 'nullable|max:255',
            'asesor_id' => 'required|exists:asesores,id',
            'empresa_id' => 'required|exists:empresas,id'
        ]);

        $proyecto->update($request->all());

        return redirect()->route('proyectos.index')->with('success', 'Edición exitosa');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function cambiarEstado(Proyecto $proyecto)
    {
        $etapas = Etapa::all();
        $estados = Estado::all();
        return view('secretaria.proyecto.cambiar-estado', compact('proyecto', 'etapas', 'estados'));
    }

    public function updateEstado(Request $request, Proyecto $proyecto)
    {
        $proyecto->update([
            'estado_id' => $request->get('estado')
        ]);

        return redirect()->route('proyectos.index')->with('success', 'Operación exitosa');
    }

    public function updateEtapa(Request $request, Proyecto $proyecto)
    {
        $proyecto->update([
            'etapa_id' => $request->get('etapa_id')
        ]);

        return redirect()->route('proyectos.index')->with('success', 'Operación exitosa');
    }

    public function addResolucion(Proyecto $proyecto)
    {
        return view('secretaria.proyecto.add-resolucion', compact('proyecto'));
    }

    public function storeAddResolucion(Request $request, Proyecto $proyecto)
    {
        //Validacion
        $request->validate([
            'tipo' => 'required',
            'resolucion_path' => 'required'
        ]);

        $tipo = "";
        $descripcion = "";
        //Cálculos
        switch ($request->tipo) {
            case "1":
                $tipo = "jurado evaluador";
                $descripcion = "Resolución para la asignación del jurado evaluador. " . $request->descripcion;
                break;
            case "2":
                $tipo = "evaluación del proyecto de tesis";
                $descripcion = "Resolución que aprueba o descarta un proyecto de tesis. " . $request->descripcion;
                break;
            case "3":
                $tipo = "Caducidad del proyecto de tesis";
                $descripcion = "Resolución que se emite cuando el tesista no ejecutó el proyecto de tesis en el periodo establecido. " . $request->descripcion;
                break;
        }

        //Manejo del archivo
        $uploadedFile = $request->file('resolucion_path');
        $uniqueFileName = uniqid() . '.' . $uploadedFile->getClientOriginalExtension();
        $uploadedFile->storeAs('resoluciones', $uniqueFileName);

        try {
            DB::beginTransaction();

            //Crear una nueva resolución el el proyecto
            $proyecto->resoluciones()->create([
                'tipo' => $tipo,
                'descripcion' => $descripcion,
                'resolucion_path' => $uniqueFileName
            ]);

            if ($request->tipo === "1") {
                //Actualizar la etapa del proyecto
                Proyecto::where('id', $proyecto->id)
                    ->update([
                        'etapa_id' => 2
                    ]);
            }

            if ($request->tipo === "2") {
                //Actualizar la etapa del proyecto
                Proyecto::where('id', $proyecto->id)
                    ->update([
                        'etapa_id' => 3
                    ]);
            }

            if ($request->tipo === "3") {
                //Actualizar la etapa del proyecto
                Proyecto::where('id', $proyecto->id)
                    ->update([
                        'etapa_id' => 5
                    ]);
            }


            DB::commit();
        } catch (Exception $e) {
            dd($e);
            DB::rollBack();
        }

        return redirect()->route('proyectos.index')->with('success', 'Resolución creada exitosamente');
    }

    public function downloadResolucion(Request $request, String $id)
    {
        $resolucion = Resolucion::find($id);
        $path = public_path('/storage/resoluciones/' . $resolucion->resolucion_path);
        return response()->download($path);
    }

    public function destroyResolucion(Request $request, String $id)
    {
        $resolucion = Resolucion::find($id);

        $name_document = $resolucion->resolucion_path;
        Storage::delete('resoluciones/' . $name_document);
        $resolucion->delete();

        return redirect()->route('proyectos.index')->with('success','Eliminación exitosa');
    }
}

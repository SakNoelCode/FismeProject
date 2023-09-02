<?php

namespace App\Http\Controllers\Tesista;

use App\Http\Controllers\Controller;
use App\Models\Actividad;
use App\Models\Estado;
use App\Models\Etapa;
use App\Models\Proyecto;
use App\Models\Tesista;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProyectoTesistaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $idTesista = Tesista::where('user_id', Auth::id())->first();
        $proyectos = Proyecto::with('actividades')->where('tesista_id', $idTesista->id)->get();
        //dd($proyectos->first());
        return view('tesista.proyecto.index', compact('proyectos'));
    }

    public function verEstado(Proyecto $proyecto)
    {
        $etapas = Etapa::all();
        $estados = Estado::all();
        return view('tesista.proyecto.ver-estado', compact('proyecto', 'etapas','estados'));
    }

    public function crearActividad(Proyecto $proyecto)
    {
        return view('tesista.proyecto.crear-actividad', compact('proyecto'));
    }

    public function storeActividad(Request $request, Proyecto $proyecto)
    {
        $request->validate([
            'name' => 'required|max:255',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date',
            'tipo' => 'required|integer'
        ]);

        //Agregar una nueva columna a la request, que sea is_entregable
        $request->merge(['is_entregable' => (int) $request->tipo]);

        //Agregar una nueva columna que sea el estado
        $request->merge(['estado' => 'pendiente']);

        try {
            DB::beginTransaction();

            $proyecto->actividades()->create($request->all());

            DB::commit();
        } catch (Exception $e) {
            dd($e);
            DB::rollBack();
        }

        return redirect()->route('proyectoTesista.index')->with('success', 'Actividad añadidad exitosamente');
    }

    public function editActividad(Proyecto $proyecto, Actividad $actividad)
    {
        return view('tesista.proyecto.edit-actividad', compact('proyecto', 'actividad'));
    }

    public function updateActividad(Request $request, Proyecto $proyecto, Actividad $actividad)
    {
        $request->validate([
            'name' => 'required|max:255',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date'
        ]);

        //Agregar una nueva columna que sea el estado
        if ($request->exists('completado-checkbox')) {
            $request->merge(['estado' => 'completado']);
        } else {
            $request->merge(['estado' => 'pendiente']);
        }

        $requestOk = $request->except('_token', '_method', 'completado-checkbox');

        //dd($requesOk);

        try {
            DB::beginTransaction();

            $proyecto->actividades()
                ->where('id', $actividad->id)
                ->update($requestOk);

            DB::commit();
        } catch (Exception $e) {
            dd($e);
            DB::rollBack();
        }

        return redirect()->route('proyectoTesista.index')->with('success', 'Actividad editada exitosamente');
    }

    public function updateFecha(Request $request, Proyecto $proyecto)
    {
        $request->validate([
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date'
        ]);

        try {
            DB::beginTransaction();


            $proyecto->update([
                'fecha_inicio' => $request->fecha_inicio,
                'fecha_fin' => $request->fecha_fin
            ]);

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
        }

        return redirect()->route('proyectoTesista.index')->with('success', 'Fecha actualizada');
    }
}

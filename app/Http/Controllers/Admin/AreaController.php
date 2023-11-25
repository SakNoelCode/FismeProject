<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Area;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AreaController extends Controller
{
    public function index(): View
    {
        return view('admin.pages.area.index');
    }

    public function fetchRegistros()
    {
        $registros = Area::all();
        return response()->json([
            'data' => $registros
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|max:100|unique:areas,nombre',
            'descripcion' => 'required|max:250'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'message' => 'Error en la validación',
                'errors' => $validator->messages()
            ]);
        }

        try {
            Area::create($validator->validated());

            return response()->json([
                'status' => 200,
                'message' => 'Registro exitoso'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => 'Error en la creación del registro',
                'error' => $e->getMessage()
            ]);
        }
    }

    public function editRegistro(String $id)
    {
        $registro = Area::find($id);

        if ($registro) {
            return response()->json([
                'status' => 200,
                'data' => $registro
            ]);
        }
        return response()->json([
            'status' => 404,
            'message' => 'No se encontro el registro'
        ]);
    }

    public function updateRegistro(Request $request, String $id)
    {
        $registro = Area::find($id);
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|max:100|unique:areas,nombre,' . $id,
            'descripcion' => 'required|max:250'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages()
            ]);
        }

        $registro->update($validator->validated());

        return response()->json([
            'status' => 200,
            'message' => 'Registro editado exitosamente'
        ]);
    }

    public function destroy(string $id)
    {
        Area::find($id)->delete();

        return response()->json([
            'status' => 200,
            'message' => 'Registro eliminado exitosamente'
        ]);
    }
}

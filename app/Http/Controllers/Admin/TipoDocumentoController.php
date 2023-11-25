<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tipodocumento;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TipoDocumentoController extends Controller
{
    public function index(): View
    {
        return view('admin.pages.tipoDocumento.index');
    }

    public function fetchTipodocumentos()
    {
        $registros = Tipodocumento::all();
        return response()->json([
            'data' => $registros
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|max:100|unique:tipodocumentos,nombre',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages()
            ]);
        }

        Tipodocumento::create($validator->validated());

        return response()->json([
            'status' => 200,
            'message' => 'Registro exitoso'
        ]);
    }

    public function editTipodocumento(String $id)
    {
        $registro = Tipodocumento::find($id);

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

    public function updateTipodocumento(Request $request, String $id)
    {
        //dd($request);
        $registro = Tipodocumento::find($id);
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|max:100|unique:tipodocumentos,nombre,' . $id,
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
        Tipodocumento::find($id)->delete();

        return response()->json([
            'status' => 200,
            'message' => 'Registro eliminado exitosamente'
        ]);
    }
}

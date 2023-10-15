<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Empresa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EmpresaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //$empresas = Empresa::paginate(5);
        return view('admin.pages.empresa.index');
    }

    public function fetchEmpresas()
    {
        $empresas = Empresa::all();
        return response()->json([
            'data' => $empresas
        ]);
    }

    public function editEmpresa(String $id)
    {
        $empresa = Empresa::find($id);

        if ($empresa) {
            return response()->json([
                'status' => 200,
                'data' => $empresa
            ]);
        }
        return response()->json([
            'status' => 404,
            'message' => 'No se encontro a la empresa'
        ]);
    }

    public function updateEmpresa(Request $request, String $id)
    {
        $empresa = Empresa::find($id);
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255|unique:empresas,name,' . $id,
            'email' => 'nullable|unique:empresas,email,' . $id,
            'phone' => 'nullable|max:40',
            'address' => 'nullable|max:100',
            'web_url' => 'nullable',
            'city' => 'nullable|max:100',
            'description' => 'nullable'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages()
            ]);
        }

        $empresa->update($validator->validated());

        return response()->json([
            'status' => 200,
            'message' => 'Empresa editada exitosamente'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255|unique:empresas,name',
            'email' => 'nullable|unique:empresas,email',
            'phone' => 'nullable|max:40',
            'address' => 'nullable|max:100',
            'web_url' => 'nullable',
            'city' => 'nullable|max:100',
            'description' => 'nullable'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages()
            ]);
        }

        Empresa::create($validator->validated());

        return response()->json([
            'status' => 200,
            'message' => 'Empresa creada exitosamente'
        ]);
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
        $empresa = Empresa::find($id)->delete();

        return response()->json([
            'status' => 200,
            'message' => 'Empresa eliminada exitosamente'
        ]);
    }

    public function createForSecretaria()
    {
        return view('secretaria.proyecto.create-empresa');
    }

    public function storeForSecretaria(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255|unique:empresas,name',
            'email' => 'nullable|unique:empresas,email',
            'phone' => 'nullable|max:40',
            'address' => 'nullable|max:100',
            'web_url' => 'nullable',
            'city' => 'nullable|max:100',
            'description' => 'nullable'
        ]);

        Empresa::create($request->all());

        return redirect()->route('proyectos.index')->with('success', 'Empresa agregada exitosamente');
    }
}

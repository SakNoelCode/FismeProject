<?php

namespace App\Http\Controllers\Admin;

use App\Events\saveAsesorEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\storeAsesorRequest;
use App\Models\Asesor;
use App\Models\Escuela;
use App\Models\User;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AsesorController extends Controller
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
    public function create(): View
    {
        $escuelas = Escuela::all();
        return view('admin.pages.user.createAsesor', compact('escuelas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(storeAsesorRequest $request): RedirectResponse
    {
        saveAsesorEvent::dispatch($request->validated());
        return redirect()->route('usuarios.index')->with('success', 'Asesor agregado exitosamente');
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
    public function edit(String $id): View
    {
        $asesor = Asesor::where('user_id', $id)->firstOrFail();
        $escuelas = Escuela::all();
        return view('admin.pages.user.editarAsesor', compact('asesor', 'escuelas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, String $id): RedirectResponse
    {
        //Buscar un usuario que una relación con tesista y que coincida con el campo que esta
        //viniendo de la vista
        $user = User::whereHas('asesor', function ($query) use ($id) {
            $query->where('id', '=', $id);
        })->first();

        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'especialidad' => 'required|max:100',
            'escuela_id' => 'required|integer|exists:escuelas,id',
            'password'  => 'nullable|same:password_confirm|min:6|different:email'
        ]);

        try {
            DB::beginTransaction();

            /*Comprobar el password y aplicar el Hash*/
            if (empty($request->password)) {
                $request = Arr::except($request, array('password'));
            } else {
                $fieldHash = Hash::make($request->password);
                $request->merge(['password' => $fieldHash]);
            }

            $user->update($request->except('especialidad', 'escuela_id'));

            Asesor::where('user_id', $user->id)
                ->update($request->only('especialidad', 'escuela_id'));

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
        }

        return redirect()->route('usuarios.index')->with('success', 'Asesor editado exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

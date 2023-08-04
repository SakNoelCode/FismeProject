<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Escuela;
use App\Models\User;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
    public function create():View
    {
        $escuelas = Escuela::all();
        return view('admin.pages.user.createAsesor', compact('escuelas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request):RedirectResponse
    {
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'especialidad' => 'required|max:100',
            'escuela_id' => 'required|integer|exists:escuelas,id',
            'password'  => 'required|same:password_confirm|min:6|different:email'
        ]);

        try {
            DB::beginTransaction();
            $user = User::create($request->only('name', 'email', 'password'));
            $user->asesores()->create(
                $request->merge(['user_id' => $user->id])->except('name', 'email', 'password')
            );

            //Agregar rol al usuario
            $user->assignRole('asesor');

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
        }

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

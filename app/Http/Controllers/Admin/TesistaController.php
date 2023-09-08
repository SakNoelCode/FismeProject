<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Escuela;
use App\Models\Tesista;
use App\Models\User;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class TesistaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $escuelas = Escuela::all();
        return view('admin.pages.user.createTesista', compact('escuelas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'codigo' => 'required|max:50',
            'escuela_id' => 'required|integer|exists:escuelas,id',
            'password'  => 'required|same:password_confirm|min:6|different:email'
        ]);

        try {
            DB::beginTransaction();
            $user = User::create($request->only('name', 'email', 'password'));
            $user->tesista()->create(
                $request->merge(['user_id' => $user->id])->except('name', 'email', 'password')
            );

            //Agregar rol al usuario
            $user->assignRole('tesista');

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
        }

        return redirect()->route('usuarios.index')->with('success', 'Tesista agregado exitosamente');
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
    public function edit(string $id): View
    {
        //Comprobar la existencia del tesista
        $tesista = Tesista::where('user_id', $id)->firstOrFail();
        $escuelas = Escuela::all();
        return view('admin.pages.user.editarTesista', compact('tesista', 'escuelas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        //Buscar un usuario que una relación con tesista y que coincida con el campo que esta
        //viniendo de la vista
        $user = User::whereHas('tesista', function ($query) use ($id) {
            $query->where('id', '=', $id);
        })->first();

        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'codigo' => 'required|max:50',
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

            $user->update($request->except('codigo', 'escuela_id'));

            Tesista::where('user_id', $user->id)
                ->update($request->only('codigo', 'escuela_id'));

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
        }

        return redirect()->route('usuarios.index')->with('success', 'Tesista editado exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function createForSecretaria(): View
    {
        $escuelas = Escuela::all();
        return view('secretaria.proyecto.create-tesista', ['escuelas' => $escuelas]);
    }

    public function storeForSecretaria(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'codigo' => 'required|max:50',
            'escuela_id' => 'required|integer|exists:escuelas,id',
            'password'  => 'required|same:password_confirm|min:8|different:email'
        ]);

        try {
            DB::beginTransaction();
            $user = User::create($request->only('name', 'email', 'password'));
            $user->tesista()->create(
                $request->merge(['user_id' => $user->id])->except('name', 'email', 'password')
            );

            //Agregar rol al usuario
            $user->assignRole('tesista');

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
        }

        return redirect()->route('proyectos.index')->with('success', 'Tesista agregado exitosamente');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Escuela;
use App\Models\Tesista;
use App\Models\User;
use Exception;
use GuzzleHttp\Psr7\Response;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\JsonResponse;

class UserController extends Controller
{
    /**
     * Mostrar vista de usuarios.
     */
    public function index(): View
    {
        $escuelas = Escuela::all();
        return view('admin.pages.user.index', compact('escuelas'));
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
        try {
            DB::beginTransaction();

            /*Realizar validaciones
            $validator = Validator::make($request->all(), [
                'name' => 'required|max:255',
                'email' => 'required|email|max:255',
                'codigo' => 'required|max:50',
                'escuela_id' => 'required|integer|exists:escuelas,id',
                'password'  => 'required|same:confirm_password|min:6|different:email'
            ]);

            //Si la validación falla
            if ($validator->fails()) {
                return response()->json([
                    'status' => 400,
                    'errors' => $validator->messages()
                ]);
            }*/

            /*Si no falla se crear un nuevo usuario tesista
            $user = User::create([$validator->safe()->only('name', 'email', 'password')]);
            $user->tesistas()->create(
                $validator->safe()->merge(['user_id' => $user->id])->except(['name', 'email', 'password'])
            );*/

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
        }

        //Respuesta
        return response()->json([
            'status' => 200,
            'message' => 'Tesista creado exitosamente'
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
        //
    }
}

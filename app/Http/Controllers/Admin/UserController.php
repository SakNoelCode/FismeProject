<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Mostrar vista de usuarios.
     */
    public function index(Request $request): View
    {
        $search = $request->get('name-search');

        if ($search === null) {
            $users = User::with('tesista.escuela', 'asesor.escuela', 'secretaria.escuela')
                ->latest()
                ->paginate(5);
        } else {
            $users = User::with('tesista.escuela', 'asesor.escuela', 'secretaria.escuela')
                ->where('name', 'like', "%$search%")
                ->latest()
                ->paginate(5);
        }

        return view('admin.pages.user.index', compact('users','search'));
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

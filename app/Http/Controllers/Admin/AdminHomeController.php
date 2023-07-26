<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminHomeController extends Controller
{
    /**
     * Mostrar vista de Login
     */
    public function index(): View
    {
        if (!Auth::check()) {
            return view('admin.login');
        }
        return view('admin.dashboard');
    }

    /**
     * Mostrar dashboard del administrador
     */
    public function dashboard(): View
    {
        return view('admin.dashboard');
    }

    /**
     * Cerrar sesión
     */
    public function logout(Request $request): RedirectResponse
    {

        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/admin');
    }
}

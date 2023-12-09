<?php

namespace App\Http\Controllers\Practicante;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\Expediente;
use App\Models\Practica;
use App\Models\Practicante;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;


class AuthController extends Controller
{
    public function showLogin(): View
    {
        return view('practicante.auth.login');
    }

    public function login(LoginRequest $request)
    {
        $request->authenticate();

        $request->session()->regenerate();

        return redirect()->route('practicante.showHome');
    }

    public function ShowRegister(): View
    {
        return view('practicante.auth.register');
    }

    public function register(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $user->assignRole('practicante');

        Practicante::create([
            'user_id' => $user->id,
            'razon_social' => $user->name
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect()->route('practicante.showHome');
    }
}

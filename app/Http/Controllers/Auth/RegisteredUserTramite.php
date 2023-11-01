<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Remitente;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Support\Facades\Hash;

class RegisteredUserTramite extends Controller
{

    public function login(): View
    {
        return view('auth.login-user-tramite');
    }

    public function loginAutenticate(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        return redirect()->route('tramite.showHome');
    }

    public function create(): View
    {
        return view('auth.register-user-tramite');
    }

    public function store(Request $request): RedirectResponse
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

        $user->assignRole('remitente');

        Remitente::create([
            'user_id' => $user->id
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect()->route('tramite.showHome');
    }
}

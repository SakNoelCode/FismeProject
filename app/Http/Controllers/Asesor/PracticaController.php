<?php

namespace App\Http\Controllers\Asesor;

use App\Http\Controllers\Controller;
use App\Models\Practicante;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;

class PracticaController extends Controller
{
    public function index(): View
    {
        $practicantes = Practicante::where('asesore_id', Auth::user()->asesor->id)->paginate(5);
        return view('asesor.practica.index', compact('practicantes'));
    }
}

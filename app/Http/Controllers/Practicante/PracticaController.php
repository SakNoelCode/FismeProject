<?php

namespace App\Http\Controllers\Practicante;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PracticaController extends Controller
{
    public function showHome()
    {
        return view('practicante.home');
    }
}

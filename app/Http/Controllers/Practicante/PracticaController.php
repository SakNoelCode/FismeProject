<?php

namespace App\Http\Controllers\Practicante;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePracticanteRequest;
use App\Models\Escuela;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PracticaController extends Controller
{
    public function showHome()
    {
        return view('practicante.home');
    }

    public function createPracticante()
    {
        $escuelas = Escuela::all();
        return view('practicante.create', compact('escuelas'));
    }

    public function storePracticante(StorePracticanteRequest $request)
    {
        try {
            DB::beginTransaction();
            Auth::user()->practicante->update($request->validated());
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            dd($e);
        }

        return redirect()->route('practicante.createPracticante')->with('status','practicante.saved');
    }
}

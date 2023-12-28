<?php

namespace App\Http\Controllers\Asesor;

use App\Http\Controllers\Controller;
use App\Models\Practica;
use App\Models\Practicante;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ComisionController extends Controller
{
    public function index()
    {
        $practicantes = Practicante::with('practica.actas')
        ->latest()
        ->get();

        //dd($practicantes);
        return view('asesor.comision.index',compact('practicantes'));
    }

    public function verPDF(String $name)
    {
        $filePath = 'actas/' . $name;


        if (Storage::disk('public')->exists($filePath)) {

            $pdfPath = Storage::disk('public')->path($filePath);

            return response()->file($pdfPath);
        } else {
            return redirect()->back()->withErrors(['El archivo PDF no existe.']);
        }
    }
}

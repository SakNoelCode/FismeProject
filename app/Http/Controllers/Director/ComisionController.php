<?php

namespace App\Http\Controllers\Director;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateComisionRequest;
use App\Models\Asesor;
use App\Models\Comision;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;

class ComisionController extends Controller
{
    public function index(): View
    {
        $comision = Comision::first();
        return view('director.comision.index', compact('comision'));
    }

    public function create(): View
    {
        $asesores = Asesor::all();
        return view('director.comision.create', compact('asesores'));
    }

    public function update(UpdateComisionRequest $request): RedirectResponse
    {
        try {
            DB::beginTransaction();
            $comision = Comision::first();
            if ($comision === null) {
                $nuevaComision = Comision::create($request->validated());

                foreach ($request->asesores as $item) {
                    $asesor = Asesor::find($item);
                    $asesor->update([
                        'comision_id' => $nuevaComision->id
                    ]);
                }
            } else {
                $comision->update($request->validated());

                Asesor::whereNotNull('comision_id')->update(['comision_id' => null]);

                foreach ($request->asesores as $item) {
                    $asesor = Asesor::find($item);
                    $asesor->update([
                        'comision_id' => $comision->id
                    ]);
                }
            }
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            dd($e);
        }

        return redirect()->route('director.comision.index')->with('success', 'Comisión asignada');
    }
}

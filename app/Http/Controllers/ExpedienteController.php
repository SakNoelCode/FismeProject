<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreExpedienteRequest;
use App\Models\Documento;
use App\Models\Expediente;
use App\Models\Remitente;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;

class ExpedienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('expediente.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreExpedienteRequest $request)
    {
        //dd($request);

        //Generar la numeración para el expediente (Eso se gestiona el el modelo de manera automática)

        try {
            DB::beginTransaction();

            //Tabla remitente
            $remitente = Remitente::create($request->only('razon_social', 'numero_documento', 'email'));

            //Tabla documento
            $documento = new Documento();
            $nameDocumento = $documento->guardarDocumento($request->file('nombre_path'));
            $documento->fill([
                'descripcion' => $request->descripcion,
                'tipo' => $request->tipo,
                'nombre_path' => $nameDocumento
            ]);
            $documento->save();

            //Tabla expediente
            $expediente = new Expediente();
            $codigo = $expediente->generateCodigoSeguridad();
            $fecha = $expediente->generateFecha();

            $expediente->fill([
                'codigo' => $codigo,
                'fecha_recepcion' => $fecha,
                'remitente_id' => $remitente->id,
                'documento_id' => $documento->id,
                'area_id' => 5 //Designar a mesa de partes por defecto
            ]);

            $expediente->save();

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
        }

        //Generar Cargo del documento
        $pdf = PDF::loadview(
            'pdf-vista',
            [
                'remitente' => $remitente,
                'documento' => $documento,
                'expediente' => $expediente
            ]
        );

        // Genera un nombre de archivo único para el PDF
        $pdfFileName = uniqid('pdf_') . '.pdf';

        // Almacena el PDF en el sistema de archivos temporal
        Storage::disk('local')->put('temp/' . $pdfFileName, $pdf->output());

        // Ejecuta JavaScript para abrir una nueva ventana emergente y mostrar el PDF
        echo "<script>
         var popup = window.open('/ruta-a-mostrar-pdf/{$pdfFileName}', 'popup_window', 'width=800,height=600');
         if (!popup) {
             alert('No se pudo abrir la ventana emergente. Asegúrate de permitir las ventanas emergentes en tu navegador.');
         }else{
             // Demora la redirección en 2 segundos (ajusta el tiempo según sea necesario)
         setTimeout(function () {
             window.location.href = '/mesa-de-partes';
         }, 2000); // 2000 milisegundos (2 segundos)
         }
     </script>";


        //return redirect()->route('mesa-de-partes')->with('success', 'Trámite enviada exitosamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(String $id)
    {
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

    /*
    public function generarPDF()
    {

        $data = [
            'title' => 'CARGO',
            'numeracion' => '00001',
        ];


        $pdf = PDF::loadview('pdf-vista', ['data' => $data]);

        // return view('pdf-vista');
        //return $pdf->stream('archivo.pdf');

        // Obtén el contenido PDF como una cadena
        //$pdfContent = $pdf->output();

        // Genera un identificador único para la ventana emergente
        //$popupId = uniqid('popup_');

        // Ejecuta JavaScript para abrir una nueva ventana emergente y mostrar el PDF
        //return view('abrir_pdf_popup', compact('popupId', 'pdfContent'));


        // Genera un nombre de archivo único para el PDF
        $pdfFileName = uniqid('pdf_') . '.pdf';

        // Almacena el PDF en el sistema de archivos temporal
        Storage::disk('local')->put('temp/' . $pdfFileName, $pdf->output());

        // Ejecuta JavaScript para abrir una nueva ventana emergente y mostrar el PDF
        echo "<script>
        var popup = window.open('/ruta-a-mostrar-pdf/{$pdfFileName}', 'popup_window', 'width=800,height=600');
        if (!popup) {
            alert('No se pudo abrir la ventana emergente. Asegúrate de permitir las ventanas emergentes en tu navegador.');
        }else{
            // Demora la redirección en 2 segundos (ajusta el tiempo según sea necesario)
        setTimeout(function () {
            window.location.href = '/';
        }, 2000); // 2000 milisegundos (2 segundos)
        }
    </script>";

        // Redirige al usuario al home
        //return redirect('/');
    }*/



    public function mostrarPDFTemporalmente($fileName)
    {
        $filePath = 'temp/' . $fileName;

        // dd($filePath);

        if (Storage::disk('local')->exists($filePath)) {

            $file = Storage::disk('local')->get($filePath);

            return Response::make($file, 200, [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'inline; filename="' . $fileName . '"',
            ]);
        } else {
            return redirect()->back()->withErrors(['El archivo PDF no existe.']);
        }
    }

    public function buscarExpediente(Request $request)
    {

        $numero_expediente = $request->get('numeracion');
        $codigo_seguridad = $request->get('codigo');

        if ($numero_expediente != null && $codigo_seguridad != null) {

            $request->validate([
                'numeracion' => 'required|max:5|min:5',
                'codigo' => 'required|max:6|min:6'
            ]);

            $expediente = Expediente::where('numeracion', $numero_expediente)
                ->where('codigo', $codigo_seguridad)
                ->first();

            return view('expediente.buscar', compact('expediente', 'numero_expediente', 'codigo_seguridad'));
        }

        return view('expediente.buscar');
    }

    public function showPDF(String $name)
    {
        $filePath = 'documentos/' . $name;


        if (Storage::disk('public')->exists($filePath)) {

            $pdfPath = Storage::disk('public')->path($filePath);

            return response()->file($pdfPath);
        } else {
            return redirect()->back()->withErrors(['El archivo PDF no existe.']);
        }
    }
}

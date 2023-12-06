<?php

namespace App\Listeners;

use App\Events\enviarCorreoDocente;
use App\Mail\EnviarDocumentoDocenteMail;
use App\Models\Asesor;
use App\Models\Tipodocumento;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class mailCorreoDocente
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(enviarCorreoDocente $event): void
    {
        foreach ($event->asesores as $asesor) {
            $asesor = Asesor::find($asesor);
            $documento = Tipodocumento::find($event->tipoDocumento);

            $nameAsesor = $asesor->user->name;
            $emailAsesor = $asesor->user->email;
            $asunto = $event->asunto;
            $tipoDocumento = $documento->nombre;

            Mail::to($emailAsesor)->send(new EnviarDocumentoDocenteMail($nameAsesor, $asunto, $tipoDocumento, $event->arrayDocumentos));
           // Mail::to($emailAsesor)->queue(new EnviarDocumentoDocenteMail($nameAsesor, $asunto, $tipoDocumento, $event->arrayDocumentos));
        }
    }
}

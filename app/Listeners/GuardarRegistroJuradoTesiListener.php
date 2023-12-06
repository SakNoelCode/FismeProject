<?php

namespace App\Listeners;

use App\Events\saveAsignarJuradoEvent;
use App\Models\Juradotesi;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class GuardarRegistroJuradoTesiListener
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
    public function handle(saveAsignarJuradoEvent $event): void
    {
        try {
            DB::beginTransaction();
            if (!$event->proyecto->juradotesi_id) {
                $jurado = Juradotesi::create($event->request);
                $event->proyecto->juradotesis()->associate($jurado)->save();
            } else {
                $event->proyecto->juradotesis()->update($event->request);
            }
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('error:' . $e->getMessage());
            throw $e;
        }
    }
}

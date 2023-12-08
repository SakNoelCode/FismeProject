<?php

namespace App\Listeners;

use App\Models\User;
use Exception;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Http\Request;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class guardarAsesorListener
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
    public function handle(object $event): void
    {
        try {
            DB::beginTransaction();

            $requestData = $event->request;
            if (!($requestData instanceof Request)) {
                // Convierte el array en un objeto Request
                $requestData = new Request($requestData);
            }

            $user = User::create($requestData->only('name', 'email', 'password'));
            $user->asesor()->create(
                $requestData->merge(['user_id' => $user->id])->except('name', 'email', 'password')
            );

            //Agregar rol al usuario
            $user->assignRole('asesor');

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('error:' . $e->getMessage());
            throw $e;
        }
    }
}

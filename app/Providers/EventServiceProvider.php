<?php

namespace App\Providers;

use App\Events\enviarCorreoDocente;
use App\Events\saveAsesorEvent;
use App\Events\saveAsignarJuradoEvent;
use App\Listeners\guardarAsesorListener;
use App\Listeners\GuardarRegistroJuradoTesiListener;
use App\Listeners\mailCorreoDocente;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        enviarCorreoDocente::class => [
            mailCorreoDocente::class
        ],
        saveAsignarJuradoEvent::class => [
            GuardarRegistroJuradoTesiListener::class
        ],
        saveAsesorEvent::class => [
            guardarAsesorListener::class
        ],
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}

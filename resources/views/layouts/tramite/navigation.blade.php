<div class="mt-12 flex flex-col space-y-7 text-gray-500 font-medium">

    <x-nav-link-tramite :href="route('tramite.showHome')" :active="request()->routeIs('tramite.showHome')">
        Inicio
    </x-nav-link-tramite>

    <x-nav-link-tramite :href="route('tramite.createDatosRemitente')" :active="request()->routeIs('tramite.createDatosRemitente')">
        Datos 
    </x-nav-link-tramite>

    <x-nav-link-tramite :href="route('tramite.indexExpedienteRemitente')" :active="request()->routeIs('tramite.indexExpedienteRemitente')">
        Expedientes
    </x-nav-link-tramite>

    <x-nav-link-tramite :href="route('tramite.showRespuestasExpedienteRemitente')" :active="request()->routeIs('tramite.showRespuestasExpedienteRemitente')">
        Respuestas
    </x-nav-link-tramite>

    
</div><!-- /Menu -->
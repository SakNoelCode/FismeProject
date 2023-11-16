<div class="mt-12 flex flex-col space-y-7 text-gray-500 font-medium">

    <x-nav-link-tramite :href="route('practicante.showHome')" :active="request()->routeIs('practicante.showHome')">
        Inicio
    </x-nav-link-tramite>

    <x-nav-link-tramite :href="route('practicante.createPracticante')" :active="request()->routeIs('practicante.createPracticante')">
        Registro
    </x-nav-link-tramite>

    <x-nav-link-tramite :href="route('practicante.createPractica')" :active="request()->routeIs('practicante.createPractica')">
        Asesor
    </x-nav-link-tramite>

    <x-nav-link-tramite :href="route('practicante.createActas')" :active="request()->routeIs('practicante.createActas')">
        Actas
    </x-nav-link-tramite>

    
</div><!-- /Menu -->
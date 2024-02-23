<nav x-data="{ open: false }" class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <img src="{{asset('img/fisme.svg')}}" alt="Logo Fisme" class="h-9">
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-nav-link>

                    <!--Menú secretaría--->
                    @hasrole('secretaria')
                    @if (Auth::user()->secretaria->area_id == 4)
                    <x-nav-link :href="route('proyectos.index')" :active="request()->routeIs('proyectos.index')">
                        {{ __('Proyectos de Tesis') }}
                    </x-nav-link>
                    <x-nav-link :href="route('secretaria.practicas.index')" :active="request()->routeIs('secretaria.practicas.index')">
                        {{ __('Prácticas') }}
                    </x-nav-link>
                    @endif

                    <x-nav-link :href="route('secretaria.expedientes.index')" :active="request()->routeIs('secretaria.expedientes.index')">
                        {{ __('Expedientes') }}
                    </x-nav-link>

                    @endhasrole

                    <!--Menú Tesista--->
                    @hasrole('tesista')
                    <x-nav-link :href="route('proyectoTesista.index')" :active="request()->routeIs('proyectoTesista.index')">
                        {{ __('Proyecto de Tesis') }}
                    </x-nav-link>
                    @endhasrole

                    <!--Menú Asesor-->
                    <?php

                    use App\Models\Comision;
                    use Illuminate\Support\Facades\Auth;

                    $comisionActiva = Comision::where('estado', 'activo')->first();
                    $is_comision = false;
                    $user = Auth::user();

                    if ($user->hasRole('asesor')) {
                        foreach ($comisionActiva->asesores as $asesor) {
                            if ($user->asesor->id == $asesor->pivot->asesore_id) {
                                $is_comision = true;
                                break;
                            }
                        }
                    }

                    ?>

                    @hasrole('asesor')
                    <x-nav-link :href="route('proyectoAsesor.index')" :active="request()->routeIs('proyectoAsesor.index')">
                        {{ __('Proyectos de Tesis') }}
                    </x-nav-link>
                    <x-nav-link :href="route('asesor.practica.index')" :active="request()->routeIs('asesor.practica.index')">
                        {{ __('Prácticas') }}
                    </x-nav-link>
                    @if ($is_comision)
                    <x-nav-link :href="route('asesor.comision.index')" :active="request()->routeIs('asesor.comision.index')">
                        {{ __('Comisión permanente') }}
                    </x-nav-link>
                    @endif
                    <x-nav-link :href="route('asesor.jurado.index')" :active="request()->routeIs('asesor.jurado.index')">
                        {{ __('Jurado calificador') }}
                    </x-nav-link>
                    @endhasrole

                    <!--Menú Director-->
                    @hasrole('director')
                    <x-nav-link :href="route('director.comision.index')" :active="request()->routeIs('director.comision.index')">
                        {{ __('Comisión permanente') }}
                    </x-nav-link>
                    <x-nav-link :href="route('director.juradoCalificador.index')" :active="request()->routeIs('director.juradoCalificador.index')">
                        {{ __('Jurado calificador') }}
                    </x-nav-link>
                    @endhasrole
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()->name }}</div>

                            <div class="ml-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')" onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>

            <!--Menú secretaría--->
            @hasrole('secretaria')

            @if (Auth::user()->secretaria->area_id === 4)
            <x-responsive-nav-link :href="route('proyectos.index')" :active="request()->routeIs('proyectos.index')">
                {{ __('Proyectos de Tesis') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('secretaria.practicas.index')" :active="request()->routeIs('secretaria.practicas.index')">
                {{ __('Prácticas') }}
            </x-responsive-nav-link>
            @endif

            <x-responsive-nav-link :href="route('secretaria.expedientes.index')" :active="request()->routeIs('secretaria.expedientes.index')">
                {{ __('Expedientes') }}
            </x-responsive-nav-link>

            @endhasrole

            <!--Menú Tesista--->
            @hasrole('tesista')
            <x-responsive-nav-link :href="route('proyectoTesista.index')" :active="request()->routeIs('proyectoTesista.index')">
                {{ __('Proyecto de Tesis') }}
            </x-responsive-nav-link>
            @endhasrole

            <!--Menú Asesor-->
            @hasrole('asesor')
            <x-responsive-nav-link :href="route('proyectoAsesor.index')" :active="request()->routeIs('proyectoAsesor.index')">
                {{ __('Proyectos de Tesis') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('asesor.practica.index')" :active="request()->routeIs('asesor.practica.index')">
                {{ __('Practicas') }}
            </x-responsive-nav-link>
            @if ($is_comision)
            <x-responsive-nav-link :href="route('asesor.comision.index')" :active="request()->routeIs('asesor.comision.index')">
                {{ __('Comisión permanente') }}
            </x-responsive-nav-link>
            @endif
            <x-responsive-nav-link :href="route('asesor.jurado.index')" :active="request()->routeIs('asesor.jurado.index')">
                {{ __('Jurado calificador') }}
            </x-responsive-nav-link>
            @endhasrole

            <!--Menú  Director-->
            @hasrole('director')
            <x-responsive-nav-link :href="route('director.comision.index')" :active="request()->routeIs('director.comision.index')">
                {{ __('Comisión permanente') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('director.juradoCalificador.index')" :active="request()->routeIs('director.juradoCalificador.index')">
                {{ __('Jurado calificador') }}
            </x-responsive-nav-link>
            @endhasrole

        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800 dark:text-gray-200">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
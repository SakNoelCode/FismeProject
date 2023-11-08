<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('css/styles.css')}}">
    <title>Prácticas</title>
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-montserrat">
    <div class="flex min-h-screen 2xl:max-w-7xl 2xl:mx-auto 2xl:border-x-2 2xl:border-indigo-50 ">
        <!-- Sidebar -->
        <aside class="bg-white w-1/5 py-10 pl-10  min-w-min border-r border-indigo-900/20 hidden sm:block ">

            <div class=" font-bold text-2xl">Prácticas</div>

            <!-- Menu -->
            @include('layouts.practicas.navigation')

        </aside><!-- /Sidebar -->

        <main class="bg-indigo-50/60 w-full py-10 px-3 sm:px-10">

            <!-- Nav -->
            <nav class="text-lg flex items-center justify-between content-center ">
                <div class=" font-semibold text-xl text-gray-800 flex space-x-4 items-center">
                    <a href="#">
                        <span class="md:hidden">
                            <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"></path>
                            </svg>

                        </span>
                    </a>
                    <span>@yield('title')</span>
                </div>

                <div class="flex space-x-5 md:space-x-10 text-gray-500 items-center content-center text-base ">

                    <a type="button" data-dropdown-toggle="userDropdown" data-dropdown-placement="bottom-start" class="cursor-pointer">
                        <div class="relative w-10 h-10 overflow-hidden rounded-full bg-gray-600">
                            <svg class="absolute w-12 h-12 text-gray-200 -left-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                    </a>
                    <!-- Dropdown menu -->
                    <div id="userDropdown" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
                        <div class="px-4 py-3 text-sm text-gray-900 dark:text-white">
                            <div>{{Auth::user()->name}}</div>
                            <div class="font-medium truncate">{{Auth::user()->email}}</div>
                        </div>

                        <div class="py-1">
                            <form action="{{route('logout')}}" method="post" class="cursor-pointer block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">
                                @csrf
                                <button type="submit">
                                    Cerrar sesión
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </nav> <!-- /Nav -->

            <section>
                <div class="bg-blue-100/70 mt-12 rounded-xl px-5 sm:px-10 pt-8 pb-4 relative">
                    @yield('content')
                </div>
            </section>



        </main>

    </div>

</body>

</html>
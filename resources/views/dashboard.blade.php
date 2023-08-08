<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <!--div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            </div>
        </div---->

        <section class="bg-white dark:bg-gray-900">
            <div class="px-4 mx-auto max-w-screen-xl lg:px-6">
                <div class="mx-auto max-w-screen-sm text-center lg:mb-16 mb-8">
                    <h2 class="mb-4 text-3xl lg:text-4xl tracking-tight font-extrabold text-gray-900 dark:text-white">Bienvenido {{auth()->user()->name}}</h2>
                    <p class="font-light text-gray-500 sm:text-xl dark:text-gray-400">Su cuenta esta registrada como {{auth()->user()->roles()->first()->name}}</p>
                </div>
            </div>
        </section>


    </div>
</x-app-layout>
@props(['action'])
<section class="bg-white dark:bg-gray-900">

    <div class="py-6 px-4 mx-auto max-w-2xl lg:py-10">

        <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">{{$title}}</h2>

        <!-----Errores de validación---->
        @include('admin.include.errors')


        <form action="{{$action}}" method="post">
            @csrf
            <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                {{$form}}
            </div>

            {{$actions}}
        </form>

    </div>
</section>
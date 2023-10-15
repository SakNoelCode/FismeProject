@extends('layouts.home')

@section('title',' - Solicitud de prácticas')

@push('css')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endpush

@section('content')

<!---Contenido aquí-->
<section class="bg-white dark:bg-gray-900 mt-14">
    <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16">
        <div class="grid md:grid-cols-2 gap-8">
            <!----Realizar trámite--->
            <div class="bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg p-8 md:p-12">
                <h2 class=" text-5xl font-extrabold bg-clip-text text-transparent bg-gradient-to-r from-blue-600 to-violet-600"> Requisitos para gestionar su trámite de prácticas pre profesionales</h2>
                {{-- <img src="{{asset('img/registro.png')}}" alt=""> --}}
                <br>
                <li><strong>LAS PRÁCTICAS SERÁN REALIZADAS LUEGO DE HABER APROBADO TODOS LOS CURSOS DEL VIII CICLO</strong></li><br>
                <li><strong>LAS PRÁCTICAS SERÁN REALIZADAS DURANTE 120 DÍAS HÁBILES Y CONTÍNUOS</strong></li><br>
                <li><strong>LAS PRÁCTICAS SERÁN REALIZADAS EN INSTITUCIONES PÚBLICAS Y/O PRIVADAS QUE UTILICEN TIC</strong></li><br>
                <li><strong>SOLICITUD DIRIGIDA AL DECANO DE LA FACULTAD</strong></li><br>
                <li><strong>CONSTANCIA DE CURSOS APROBADOS HASTA EL VIII CICLO </strong></li><br>
                <li><strong> PLAN DE PRÁCTICAS (ABALADAS Y FIRMADAS POR EL ASESOR)</strong></li><br>
                <li><strong> CARTA DE AUTORIZACIÓN EMITIDA POR LA EMPRESA</strong></li><br>
                <li><strong> COMPROBANTE DE PAGO POR DERECHO DE CARTA DE PRESENTACIÓN</strong></li><br>


                <p class="text-lg font-normal text-gray-500 dark:text-gray-400 mb-4">Estimado practicante es necesario e indispensable que 
                    usted descargue estos archivos en el siguiente enlace y así poder editar y subirlo junto con su plan de parácticas
                    de manera obligatoria.</p>
                <a href="#" class="text-red-500 dark:text-blue-500 hover:underline font-medium text-lg inline-flex items-center">Descargar Formato
                    <svg class="w-3.5 h-3.5 ml-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                        {{-- <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9" /> --}}
                    </svg>
                </a>
                <a href="{{route('practicas.crearDocumento')}}" class="text-blue-500 dark:text-blue-500 hover:underline font-medium text-lg inline-flex items-center">Registrar Documento
                    <svg class="w-3.5 h-3.5 ml-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                        {{-- <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9" /> --}}
                    </svg>
                </a>
            </div>
            <!----Realizar seguimiento--->
            <div class="bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg p-8 md:p-12">

                <h2 class="text-gray-900 dark:text-white text-3xl font-extrabold mb-2">Consultar trámite</h2>
                <p class="text-lg font-normal text-gray-500 dark:text-gray-400 mb-4">Si has registrado tu documento y quieres realizar el seguimiento a ello
                    puedes hacer clic en el siguiente enlace el cual te mostrará a seguir : 
                </p>
                <a href="#" class="text-blue-900 dark:text-blue-500 hover:underline font-medium text-lg inline-flex items-center">Read more
                    <svg class="w-3.5 h-3.5 ml-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9" />
                    </svg>
                </a>
            </div>
        </div>
    </div>
 
</section>
@if (session('success'))
<script>
    let message = "{{session('success') }}";
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 2000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    })

    Toast.fire({
        icon: 'success',
        title: message
    })
</script>
@endif
@endsection

@push('js')

@endpush
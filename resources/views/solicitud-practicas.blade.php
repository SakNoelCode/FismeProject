@extends('layouts.home')

@section('title',' - Solicitud de prácticas')

@push('css')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endpush

@section('content')

<!---Contenido aquí-->
<section class="bg-teal-400 dark:bg-gray-900 mt-14">
    <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16">
        <div class="grid md:grid-cols-3 gap-8">
            <!----Realizar trámite--->
            <div class="bg-gray-50 dark:bg-gray-800 border border-blue-700 dark:border-blue-700 rounded-lg p-8 md:p-10">
                <h2 class=" text-2xl font-extrabold bg-clip-text text-transparent bg-gradient-to-r from-blue-600 to-violet-600"> Requisitos para gestionar su trámite de prácticas pre profesionales</h2>
                {{-- <img src="{{asset('img/registro.png')}}" alt=""> --}}
                
                <li>Las prácticas serán realizadas luego de haber aprobado todos los cursos del VIII ciclo</li>
                <li>Las prácticas serán realizadas durante 120 días hábiles y contínuos</li> 
                <li>Las prácticas serán realizadas en instituciones públicas y/o privadas que usen TIC</li> 
                <li>Solicitud dirigida al decano de la facultad</li> 
                <li>Constancia de cursos aprobados hasta el VIII ciclo </li> 
                <li> Plan de prácticas (Abaladas y firmadas por el asesor)</li> 
                <li> Carta de autorización emitida por la empresa</li> 
                <li> Comprobante de pago por derecho de carta de presentación</li> 


                {{-- <p class="text-sm font-normal text-gray-500 dark:text-gray-400 mb-4">Estimado practicante es necesario e indispensable que 
                    usted descargue estos archivos en el siguiente enlace y así poder editar y subirlo junto con su plan de parácticas
                    de manera obligatoria.</p> --}}
                {{-- <a href="#" class="text-red-500 dark:text-blue-500 hover:underline font-medium text-lg inline-flex items-center">Descargar Formato
                    <svg class="w-3.5 h-3.5 ml-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                    </svg>
                </a> --}}
                <a href="{{route('practicas.crearDocumento')}}" class="text-blue-500 dark:text-blue-500 hover:underline font-medium text-lg inline-flex items-center">
                    <img src="{{ asset('img/cargarD.png') }}" width="80%">
                </a>
            </div>
            <!----Realizar seguimiento--->
            <div class="bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg p-8 md:p-12">

                <h2 class=" text-2xl font-extrabold bg-clip-text text-transparent bg-gradient-to-r from-blue-600 to-violet-600">Recursos</h2>
                <p class="text-lg font-normal text-gray-500 dark:text-gray-400 mb-4">Descargar en el siguiente enlace los documentos requeridos para su solicitud : 
                </p>
                <a href="#" class="text-blue-900 dark:text-blue-500 hover:underline font-medium text-lg inline-flex items-center">
                    j
                </a><br><br>
                <h2 class=" text-2xl font-extrabold bg-clip-text text-transparent bg-gradient-to-r from-blue-600 to-violet-600">Video ilustrativo para registro de su documento</h2>
                <div>
                    <label for="video_referencia" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                    </label>
                    <video 
                        id="video_referencia" 
                        controls 
                        width="320" 
                        height="240"
                    >
                        <source src="{{ asset('img/Mana.mp4') }}" type="video/mp4">
                        <!-- Puedes agregar más sources para diferentes formatos de video -->
                        Tu navegador no soporta el elemento de video.
                    </video>
                </div>
                
            </div>
            <div class="bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg p-8 md:p-12">

                <h2 class=" text-2xl font-extrabold bg-clip-text text-transparent bg-gradient-to-r from-blue-600 to-violet-600">Consultar trámite</h2>
                <p class="text-lg font-normal text-gray-500 dark:text-gray-400 mb-4">Si has registrado tu documento y quieres realizar el seguimiento a ello
                    puedes hacer clic en el siguiente enlace el cual te mostrará a seguir : 
                </p>
                <a href="#" class="text-blue-900 dark:text-blue-500 hover:underline font-medium text-lg inline-flex items-center">
                    <img src="{{ asset('img/buscar.png') }}" width="80%">
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
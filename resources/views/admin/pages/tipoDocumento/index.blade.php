@extends('admin.layouts.app')
@section('title','Empresas')
@section('styles')
<!---link href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-borderless/borderless.css" rel="stylesheet"---->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<style>
    #description {
        resize: none;
    }

    #edit_description {
        resize: none;
    }
</style>
@endsection
@section('header')
<h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
    {{ __('Módulo para la gestión de tipos de documentos') }}
</h2>
@endsection
@section('content')
<div class="py-6">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

        <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">

            <header>
                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                    {{ __('Tipos de documentos') }}
                </h2>

                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                    {{ __("Los tipos de documentos son necesarios para asignarlo a expedientes.") }}
                </p>
            </header>

        </div>


        <section class="bg-gray-50 dark:bg-gray-900">
            <div class="mx-auto max-w-screen-xl">
                <!-- Start coding here -->
                <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">
                    <!-----Cabecera Tabla--->
                    <div class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-4">
                        <!----Buscador--->
                        <div class="w-full md:w-1/2">
                            <form class="flex items-center">
                                <label for="simple-search" class="sr-only">Search</label>
                                <div class="relative w-full">
                                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                        <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <input type="text" id="simple-search" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 p-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Buscar" required="">
                                </div>
                            </form>
                        </div>
                        <!----Acciones--->
                        <div class="w-full md:w-auto flex flex-col md:flex-row space-y-2 md:space-y-0 items-stretch md:items-center justify-end md:space-x-3 flex-shrink-0">

                            <div class="flex items-center space-x-3 w-full md:w-auto">
                                <!---Menu Dropdown---->
                                <button id="actionsDropdownButton" data-dropdown-toggle="actionsDropdown" class="w-full md:w-auto flex items-center justify-center py-2 px-4 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700" type="button">
                                    <svg class="-ml-1 mr-1.5 w-5 h-5" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                        <path clip-rule="evenodd" fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" />
                                    </svg>
                                    Acciones
                                </button>
                                <div id="actionsDropdown" class="hidden z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600">
                                    <ul class="py-1 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="actionsDropdownButton">
                                        <li>
                                            <a id="openModalCreate" data-modal-target="modalCreate" role="button" class="openModalCreate block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Nuevo registro</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-----Tabla---->
                    <div class="overflow-x-auto">
                        <table id="tabla_empresas" class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        N°
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Nombre
                                    </th>
                                    <th scope="col" class="px-4 py-3">
                                        <span class="sr-only">Acciones</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody id="tbody">

                            </tbody>
                        </table>
                    </div>

                    <!-----Paginación---->


                </div>
            </div>
        </section>

        <!----Modal Create---->
        <div id="modalCreate" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
            <div class="relative p-4 w-full max-w-2xl h-full md:h-auto">
                <!-- Modal content -->
                <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
                    <!-- Modal header -->
                    <div class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 dark:border-gray-600">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                            Nuevo Registro
                        </h3>
                        <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" onclick="closeModalCreate()">
                            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>

                    <!-----Errores de validacoón--->
                    <div class="flex p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-900 dark:text-red-400" role="alert">
                        <svg class="flex-shrink-0 inline w-4 h-4 mr-3 mt-[2px]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                        </svg>
                        <span class="sr-only">Danger</span>
                        <div>
                            <span class="font-medium">Los campos con * son obligatorios:</span>
                            <ul id="ul-errors" class="mt-1.5 ml-4 list-disc list-inside">
                            </ul>
                        </div>
                    </div>

                    <!-- Modal body -->
                    <form action="#">
                        <div class="grid gap-4 mb-4 sm:grid-cols-2">
                            <div class="sm:col-span-2">
                                <label for="nombre" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nombre *</label>
                                <input type="text" name="nombre" id="nombre" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Solicitud">
                            </div>
                        </div>
                        <button id="btnCrearRegistro" type="submit" class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            <svg class="mr-1 -ml-1 w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path>
                            </svg>
                            Guardar
                        </button>
                    </form>
                </div>
            </div>
        </div>


        <!----Modal Edit---->
        <div id="modalEdit" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
            <div class="relative p-4 w-full max-w-2xl h-full md:h-auto">
                <!-- Modal content -->
                <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
                    <!-- Modal header -->
                    <div class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 dark:border-gray-600">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                            Editar registro
                        </h3>
                        <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" onclick="closeModalEdit()">
                            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>

                    <!-----Errores de validacoón--->
                    <div class="flex p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-900 dark:text-red-400" role="alert">
                        <svg class="flex-shrink-0 inline w-4 h-4 mr-3 mt-[2px]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                        </svg>
                        <span class="sr-only">Danger</span>
                        <div>
                            <span class="font-medium">Los campos con * son obligatorios:</span>
                            <ul id="ul-errors-edit" class="mt-1.5 ml-4 list-disc list-inside">
                            </ul>
                        </div>
                    </div>

                    <!-- Modal body -->
                    <form action="#">
                        <div class="grid gap-4 mb-4 sm:grid-cols-2">
                            <input type="hidden" name="edit_empresa_id" id="edit_registro_id">
                            <div class="sm:col-span-2">
                                <label for="edit_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nombre *</label>
                                <input type="text" name="edit_name" id="edit_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            </div>
                        </div>
                        <button id="btnEditarRegistro" type="submit" class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            Actualizar registro
                        </button>
                    </form>
                </div>
            </div>
        </div>

         <!-- Ver modal -->
         <div id="modalVer" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
            <div class="relative p-4 w-full max-w-xl h-full md:h-auto">
                <!-- Modal content -->
                <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
                    <!-- Modal header -->
                    <div class="flex justify-between mb-4 rounded-t sm:mb-5">
                        <div class="text-lg text-gray-900 md:text-xl dark:text-white">
                            <h3 class="font-semibold">
                                Modal de confirmación
                            </h3>
                        </div>
                        <div>
                            <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 inline-flex dark:hover:bg-gray-600 dark:hover:text-white" onclick="closeModalVer()">
                                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                </svg>
                                <span class="sr-only">Close modal</span>
                            </button>
                        </div>
                    </div>
                    <dl>
                        <dt class="mb-2 leading-none text-gray-900 dark:text-white">¿Seguro que quieres eliminar el registro?</span></dt>
                        <input type="hidden" name="ver_registro_id" id="ver_registro_id">
                    </dl>
                    <div class="flex justify-between items-center">
                        <div class="flex items-center space-x-3 sm:space-x-4">

                        </div>
                        <button id="btnEliminarRegistro" type="button" class="inline-flex items-center text-white bg-red-600 hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-red-500 dark:hover:bg-red-600 dark:focus:ring-red-900">
                            <svg aria-hidden="true" class="w-5 h-5 mr-1.5 -ml-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                            </svg>
                            Eliminar
                        </button>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.0/flowbite.min.js"></script>
<script>
    /**
     * Manejo del modal Create
     */
    const targetCreate = document.getElementById('modalCreate');
    const options = {
        placement: 'bottom-right',
        backdrop: 'static',
        closable: true,
        onHide: () => {
            limpiarCamposModalCreate();
            eliminarValidacionesModalCreate();
        }
    };
    const modalCreate = new Modal(targetCreate, options);

    function openModalCreate() {
        modalCreate.show();
    }

    function closeModalCreate() {
        modalCreate.hide();
    }

    //-----------------------------------------------

    /**
     * Manejo del modal edit
     */

    const targetEdit = document.getElementById('modalEdit');
    const optionsEdit = {
        placement: 'bottom-right',
        backdrop: 'static',
        closable: true,
        onHide: () => {
            limpiarCamposModalEdit();
            eliminarValidacionesModalEdit();
        }
    };
    const modalEdit = new Modal(targetEdit, optionsEdit);


    function openModalEdit() {
        modalEdit.show();
    }

    function closeModalEdit() {
        modalEdit.hide();
    }
    //------------------------------------------------

    /**
     * Manejo del modal ver
     */

    const targetVer = document.getElementById('modalVer');
    const optionsVer = {
        placement: 'bottom-right',
        backdrop: 'static',
        closable: true,
    };

    const modalVer = new Modal(targetVer, optionsVer);

    function openModalVer() {
        modalVer.show();
    }

    function closeModalVer() {
        modalVer.hide();
    }
    //------------------------------------------------

    /**----------------JQUERY  */
    $(document).ready(function() {

        //Listar empresas
        fetchRegistros();

        //Abri el modal de Create
        $(document).on('click', '.openModalCreate', function(event) {
            openModalCreate();
        });

        //Proceso para crear un nuevo registro
        $(document).on('click', '#btnCrearRegistro', function(event) {
            event.preventDefault();
            let data = {
                'nombre': $('#nombre').val(),
            }

            let ruta = "{{route('storeTipodocumentos')}}";

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: "POST",
                url: ruta,
                data: data,
                dataType: "json",
                success: function(response) {
                    if (response.status == 400) {
                        $.each(response.errors, function(index, value) {
                            $('#ul-errors').append('<li>' + value + '</li>')
                        });
                    } else {
                        closeModalCreate();
                        showMessage(response.message);
                        fetchRegistros();
                    }
                }
            });


        });

        //Escuchar el click para editar el elemento
        $(document).on('click', '#editarElemento', function(event) {
            event.preventDefault();
            let id = $(this).val();
            $.ajax({
                type: 'get',
                url: 'edit-tipodocumento/' + id,
                dataType: 'json',
                success: function(response) {
                    if (response.status == 404) {
                        showMessage(response.message, 'warning');
                    } else {
                        $('#edit_name').val(response.data.nombre);
                        $('#edit_registro_id').val(response.data.id);
                        openModalEdit();
                    }
                }
            });
        });

        //Proceso para actualizar un registro
        $(document).on('click', '#btnEditarRegistro', function(event) {
            event.preventDefault();
            $(this).text('Actualizando');
            let registro_id = $('#edit_registro_id').val();
            let data = {
                'nombre': $('#edit_name').val(),
            }
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: "PUT",
                url: "edit-tipodocumento/" + registro_id,
                data: data,
                dataType: "json",
                success: function(response) {
                    if (response.status == 400) {
                        $.each(response.errors, function(index, value) {
                            $('#ul-errors-edit').append('<li>' + value + '</li>')
                        });
                    } else {
                        closeModalEdit();
                        showMessage(response.message);
                        fetchRegistros();
                    }
                    $('#btnEditarRegistro').text('Actualizar registro');
                }
            });

        });

        //Escuchar el click para eliminar un registro
        $(document).on('click', '#verElemento', function(event) {
            event.preventDefault();
            let id = $(this).val();
            $.ajax({
                type: 'get',
                url: 'edit-tipodocumento/' + id,
                dataType: 'json',
                success: function(response) {
                    if (response.status == 404) {
                        showMessage(response.message, 'warning');
                    } else {
                        $('#ver_registro_id').val(response.data.id);
                        openModalVer();
                    }
                }
            });
        });

        //Proceso para eliminar una empresa
        $(document).on('click', '#btnEliminarRegistro', function(event) {
            event.preventDefault();
            $(this).text('Eliminando');
            let registro_id = $('#ver_registro_id').val();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: "DELETE",
                url: "delete-tipodocumento/" + registro_id,
                success: function(response) {
                    closeModalVer();
                    showMessage(response.message, 'info');
                    fetchRegistros();
                    $('#btnEliminarRegistro').text('Eliminar');
                }
            });

        });
    });

    /**Mostar mensaje emergente */
    function showMessage(message, icon = 'success') {
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
            icon: icon,
            title: message
        })
    }

    function fetchRegistros() {
        let ruta = "{{route('fetchTipodocumentos')}}"
        $.ajax({
            type: "get",
            url: ruta,
            dataType: "json",
            success: function(response) {

                $('#tbody').html('');
                $.each(response.data, function(key, value) {
                    $('#tbody').append(
                        '<tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">\
                            <td class="px-6 py-4">' + value.id + '</td>\
                            <td class="px-6 py-4">' + (value.nombre) + '</td>\
                            <td class="px-4 py-3 text-end">\
                                <div class="inline-flex rounded-md shadow-sm">\
                                <button type="button" value="' + value.id + '" id="editarElemento" class="px-4 py-2 text-sm font-medium text-blue-700 bg-white border border-gray-200 rounded-l-lg hover:bg-gray-100 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-blue-500 dark:focus:text-white">\
                                Editar\
                                </button>\
                                <button type="button" value="' + value.id + '" id="verElemento" class="px-4 py-2 text-sm font-medium text-red-600 bg-white border border-gray-200 rounded-r-md hover:bg-gray-100 hover:text-red-700 focus:z-10 focus:ring-2 focus:ring-red-700 focus:text-red-700 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-blue-500 dark:focus:text-white">\
                                Eliminar\
                                </button>\
                                </div>\
                            </td>\
                        </tr>');
                });
            }
        });
    }

    function limpiarCamposModalCreate() {
        $('#nombre').val('');
    }

    function eliminarValidacionesModalCreate() {
        $('#ul-errors').find('li').detach();
    }

    function limpiarCamposModalEdit() {
        $('#edit_name').val('');
    }

    function eliminarValidacionesModalEdit() {
        $('#ul-errors-edit').find('li').detach();
    }
</script>
@endsection
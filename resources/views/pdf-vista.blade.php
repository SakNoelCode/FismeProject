<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cargo del documento</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            margin: 60px;
        }

        .container-document {
            background-color: #ffffff;
        }

        .box-title {
            margin: 15px 30px;
            padding: 10px 60px;
        }

        .container-table {
            width: 100%;
        }

        .table {
            border-collapse: collapse;
            text-align: left;
            width: 80%;
            margin: 0px auto;
            font-size: 18px;
        }

        th,
        td {
            border: 2px solid #aaa;
            padding: 10px 5px;
        }

        .descripcion {
            background-color: #f3eae8;
        }

        .numeracion {
            margin-top: 5px;
        }

        .nota{
            width: 70%;
            margin: 40px auto;
            padding-bottom: 40px;
        }

        .nota p{
            font-size: 18px;
        }
    </style>
</head>

<body>



    <div class="container-document">
        <div class="box-title">
            <h1>Cargo</h1>
            <h2 class="numeracion">N° {{$expediente->numeracion}}</h2>
        </div>

        <div class="container-table">
            <table class="table">
                <thead>
                    <tr>
                        <th colspan="2">Datos del remitente</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="descripcion">Razón Social: </td>
                        <td>{{$remitente->razon_social}}</td>
                    </tr>
                    <tr>
                        <td class="descripcion">Numero de documento: </td>
                        <td>{{$remitente->numero_documento}}</td>
                    </tr>
                    <tr>
                        <td class="descripcion">Correo eléctrónico:</td>
                        <td>{{$remitente->email}}</td>
                    </tr>
                </tbody>
            </table>

            <br>

            <table class="table">
                <thead>
                    <tr>
                        <th colspan="2">Datos Generales</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="descripcion">Número de expediente: </td>
                        <td>{{$expediente->numeracion}}</td>
                    </tr>
                    <tr>
                        <td class="descripcion">Código de seguridad: </td>
                        <td>{{$expediente->codigo}}</td>
                    </tr>
                    <tr>
                        <td class="descripcion">Fecha de envío:</td>
                        <td>{{$expediente->fecha_recepcion}}</td>
                    </tr>
                    <tr>
                        <td class="descripcion">Tipo de documento:</td>
                        <td>{{$documento->tipo}}</td>
                    </tr>
                    <tr>
                        <td class="descripcion">Descripcion:</td>
                        <td>{{$documento->descripcion}}</td>
                    </tr>
                </tbody>
            </table>

            <div class="nota">
                <p>Nota: Descargue este cargo y guardelo en un lugar seguro, recurde que a través del N° de expediente
                    y el código de seguridad, usted podrá realizar un seguimiento a este trámite </p>
            </div>
        </div>
    </div>




</body>

</html>
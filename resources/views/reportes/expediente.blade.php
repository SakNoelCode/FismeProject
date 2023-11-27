<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historial de expediente</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            margin: 30px 60px;
        }

        .container-document {
            background-color: #ffffff;
        }

        .box-title {
            margin: 15px 0px;
            padding: 10px 0px;
        }

        .container-table {
            width: 100%;
        }

        .table {
            border-collapse: collapse;
            text-align: left;
            width: 100%;
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
            font-weight: 400;
        }

        .nota {
            width: 70%;
            margin: 40px auto;
            padding-bottom: 40px;
        }

        .nota p {
            font-size: 18px;
        }
    </style>
</head>

<body>

    <div class="container-document">
        <div class="box-title">
            <h3>Tabla de expedientes</h3>
            <h4 class="numeracion">Reporte generado entre las fechas de {{date("d/m/Y", strtotime($fechaInicio))}} hasta {{date("d/m/Y", strtotime($fechaFin))}}.</h4>
        </div>

        <div class="container-table">
            <table class="table">
                <thead>
                    <tr>
                        <th>Numeración</th>
                        <th>Tipo</th>
                        <th>Estado</th>
                        <th>Asunto</th>
                        <th>Area responsable</th>
                        <th>Remitente</th>
                        <th>Fecha de envío</th>
                        <th>Hora de envío</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($expedientes as $item)
                    <tr>
                        <td>
                            {{$item->numeracion}}
                        </td>
                        <td>
                            {{ucfirst($item->tipo)}}
                        </td>
                        <td>
                            {{ucfirst($item->estado)}}
                        </td>
                        <td>
                            {{$item->asunto}}
                        </td>
                        <td>
                            {{$item->area->nombre}}
                        </td>
                        <td>
                            @if ($item->expedientable instanceof App\Models\Secretaria)
                            {{$item->expedientable->user->name}}
                            @else
                            {{$item->expedientable->razon_social}}
                            @endif
                        </td>
                        <td>
                            {{date("d/m/Y", strtotime($item->created_at))}}
                        </td>
                        <td>
                            {{date("H:i", strtotime($item->created_at))}}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <br>

            <!--table class="table">
                <thead>
                    <tr>
                        <th colspan="2">Datos Generales</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="descripcion">Número de expediente: </td>
                        <td>fg</td>
                    </tr>
                    <tr>
                        <td class="descripcion">Código de seguridad: </td>
                        <td>fg</td>
                    </tr>
                    <tr>
                        <td class="descripcion">Fecha de envío:</td>
                        <td>gffg</td>
                    </tr>
                    <tr>
                        <td class="descripcion">Tipo de documento:</td>
                        <td>fgfg</td>
                    </tr>
                    <tr>
                        <td class="descripcion">Descripcion:</td>
                        <td>fgfg</td>
                    </tr>
                </tbody>
            </table>

            <div class="nota">
                <p>Nota: Descargue este cargo y guardelo en un lugar seguro, recurde que a través del N° de expediente
                    y el código de seguridad, usted podrá realizar un seguimiento a este trámite </p>
            </div---->
        </div>
    </div>




</body>

</html>
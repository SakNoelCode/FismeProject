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
            <h3>Respuestas del expediente</h3>
            <h4 class="numeracion">En la siguiente tabla se muestra todo el registro de cambios por el que ha pasado el expediente y las respuestas.</h4>
        </div>

        <div class="container-table">
            <table class="table">
                <thead>
                    <tr>
                        <th>Fecha y hora</th>
                        <th>Descripción</th>
                        <th>Documento Adjunto</th>
                        <th>Encargado</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($historial as $item)
                    <tr>
                        <td>
                            {{date("d/m/Y", strtotime($item->fecha_hora))}} - {{date("H.i", strtotime($item->fecha_hora))}}
                        </td>
                        <td>
                            {{$item->descripcion}}
                        </td>
                        <td>
                            @if ($item->documento_adjunto)
                            {{$item->documento_adjunto}}
                            @else
                            No hay documento
                            @endif
                        </td>
                        <td>
                            {{$item->user->name}}
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
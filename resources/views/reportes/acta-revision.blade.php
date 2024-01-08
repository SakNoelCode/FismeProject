<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<style>
    .body {
        margin: 60px 70px 50px 100px;
        font-size: 18px;
    }

    .titulo {
        text-align: center;
    }

    p {
        text-align: justify;
        line-height: 25px;
    }

    .firma1,
    .firma2 {
        /* border: 1px solid #ccc; Agregando bordes para visualización */
        padding: 10px;
        /* Añadiendo relleno para mejorar la apariencia */
    }

    .firma1 {
        float: left;
    }

    .firma2 {
        float: right;
    }

    .firma3 {
        text-align: center;
    }

    .docentes {
        margin: 20px;
    }

    .cargo {
        text-align: center;
        font-size: 12px;
    }
</style>

<body class="body">

    <p class="titulo">
        <strong>ACTA DE REUNIÓN PARA REVISAR PLAN DE PRÁCTICAS PRE PROFESIONALES DE LOS
            ESTUDIANTES DE LA ESCUELA PROFESIONAL DE INGENIERÍA DE SISTEMAS DE LA
            FACULTAD DE INGENIERÍA DE SISTEMAS Y MECÁNICA ELÉCTRICA</strong>
    </p>
    <p>
        Siendo las {{$hora_inicio}} horas del día {{$fecha}}, reunidos de manera presencial los
        integrantes de la Comisión de revisión, evaluación y aprobación de planes de prácticas pre
        profesional de la Escuela Profesional de Ingeniería de Sistemas, designada mediante Resolución
        de Decanato N° {{$numero}} -UNTRM/FISME, contando con la presencia de:
        <br>
    <p class="docentes">
        {{$presidente}} (Presidente)
        <br>
        {{$secretario}} (Secretario)
        <br>
        {{$vocal}} (Vocal)
    </p>


    </p>
    <p>
        Reunidos con la finalidad de:
    </p>
    <p>
        Revisar y evaluar el Plan de Prácticas Pre Profesionales presentado por el(los) estudiante(s) de la
        escuela profesional de Ingeniería de Sistemas de la Facultad de Ingeniería de Sistemas y
        Mecánica Eléctrica; después de haber escuchado la sustentación del(de los) plan(es) de prácticas
        pre profesionales, la comisión determinó:
    </p>
    @if ($aprobado)
    <p>
        <strong>APROBAR</strong> el(los) plan(es) de Prácticas Pre Profesionales presentado(s) por el(los) estudiante(s)
        de la Escuela Profesional de Ingeniería de Sistemas de la Facultad de Ingeniería de Sistemas y
        Mecánica Eléctrica que se detalla(n):
    <table border="1">
        <tr>
            <th>NOMBRES Y APELLIDOS</th>
            <th>RESULTADO</th>
        </tr>
        <tbody>
            <td>{{$nombre_practicante}}</td>
            <td>aprobado</td>

        </tbody>

    </table>

    </p>
    @else
    <p>
        <strong>OBSERVAR</strong> el(los) plan(es) de Prácticas Pre Profesionales presentado(s) por el(los)
        estudiante(s) de la Escuela Profesional de Ingeniería de Sistemas de la Facultad de Ingeniería
        de Sistemas y Mecánica Eléctrica que se detalla(n):
    <table border="1">
        <tr>
            <th>NOMBRES Y APELLIDOS</th>
            <th>OBSERVACIONES</th>
        </tr>
        <tbody>
            <td>{{$nombre_practicante}} </td>
            <td>{{$observaciones}} </td>
        </tbody>

    </table>
    </p>
    @endif
    <p>
        Siendo las {{$hora_fin}} horas se concluye la reunión y habiendo acuerdo unánime se procede a
        firmar la presente acta en señal de conformidad.
    </p><br><br>
    <br><br>
    <section>
        <div class="firma1">
            <span>-----------------------------------</span>
            <br <span><strong>{{$presidente}}</strong></span>
            <br>
            <span class="cargo">Presidente de la comisión de revisión y <br>
                Evaluación de prácticas pre profesionales
            </span>
        </div>
        <div class="firma2">
            <span>-----------------------------------</span>
            <br>
            <span><strong>{{$secretario}}</strong></span>
            <br>
            <span class="cargo">Secretario de la comisión de revisión y <br>
                Evaluación de prácticas pre profesionales
            </span>
        </div>
    </section>
    <br><br><br><br><br>
    <p>
    <div class="firma3">
        <span>-----------------------------------</span>
        <br>
        <span><strong>{{$vocal}}</strong></span>
        <br>
        <span class="cargo">Vocal de la comisión de revisión y <br>
            Evaluación de prácticas pre profesionales
        </span>
    </div>
    </p>

</body>

</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solicitud Aprobacion Prácticas</title>
</head>
<style>
    .body {
        margin: 60px 70px 50px 100px;
        font-size: 18px;
    }

    .title {
        font-weight: 800;
        display: block;
        text-align: center;
    }

    .asunto {
        display: block;
        text-align: right;
        line-height: 20px;
    }

    .asunto-box {
        text-align: start;
    }

    .negrita {
        font-weight: 600;
    }

    p {
        text-align: justify;
        line-height: 25px;
    }

    .agradecimiento {
        text-indent: 2.5em;
    }

    .agradecimiento:first-line {
        text-indent: 0;
    }

    .firma {
        margin-top: 120px;
        text-align: center;
    }
</style>

<body class="body">

    <span class="title">"AÑO DE LA UNIDAD, LA PAZ Y EL DESARROLLO"</span>
    <br>
    <span class="asunto">
        <span class="negrita">SUMILLA:</span>SOLICITO APROBACIÓN DE
        <br>
        PLAN DE PRÁCTICAS PRE
        <br>
        PROFESIONAL.
    </span>
    <br>
    <span class="negrita">SEÑOR:</span>
    <br>
    <span>DR. {{$nameDecano}}</span>
    <br>
    <span>Decano(a) de la Facultad de Ingeniería de Sistemas y Mecánica Eléctrica-FISME Bagua</span>
    <br>

    <p class="p-principal">
        Yo {{$razon_social}} estudiante y/o egresado de la Escuela Profesional de Ingeniería de
        Sistemas, Facultad de Ingeniería de Sistemas y Mecánica Eléctrica-Filial Bagua,
        identificado con DNI {{$dni}} y código de estudiante {{$codigo}}, del octavo ciclo, domicilio
        real en {{$direccion}}, que, en cumplimiento del Art. 4° del Reglamento de Practicas Pre
        Profesionales, que a la letra dice: los estudiantes podrán realizar sus prácticas pre
        profesionales, luego de haber aprobado todos los cursos del I al VIII ciclo del plan
        estudios vigente, me dirijo a usted para saludarle cordialmente y al mismo tiempo
        hacerle llegar plan de prácticas pre profesiones para revisión y aprobación.
    </p>

    <p class="agradecimiento">
        Agradeciendo por anticipado su atención a la presente, hago propicia la
        oportunidad para testimoniar las muestras de mi especial consideración y estima.
    </p>

    <p class="agradecimiento">
        Por lo expuesto ruego a usted. Proceda con la solicitud en el menor tiempo
        posible.
    </p>

    <div class="firma">
        <span>-----------------------------------</span>
        <br>
        <span>FIRMA</span>
        <br>
        <span>DNI N° {{$dni}}</span>
    </div>


    <span>Datos para contacto:</span>
    <br>
    <span>N° Celular: {{$celular}}</span>
</body>

</html>
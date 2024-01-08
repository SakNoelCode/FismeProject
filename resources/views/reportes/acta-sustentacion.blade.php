<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<style>
    .body {
      margin: 10px 10px 0px 40px;
      font-size: 15px;
  }
  .titulo{
      text-align: center;
  }
  p{
      text-align: justify;
      line-height: 20px;
  }

      .firma1, .firma2, .firma3{
      /* border: 1px solid #ccc; Agregando bordes para visualización */
      padding: 25px; /* Añadiendo relleno para mejorar la apariencia */
      }

      .firma1 {
      float: left;
      }

      .firma2 {
     float: left;
      }
      .firma3 {
      float: left;
      }
      .docentes{
          margin: 20px;
      }
      .obs{
        margin: 25px;
      }
</style>
<body class="body">
    <p class="titulo">
    <strong>ACTA DE EVALUACIÓN DE SUSTENTACIÓN DEL INFORME FINAL DE PRÁCTICAS PRE
            PROFESIONALES</strong>
    </p>
    <p>
        En la ciudad de Bagua, el día {{$fecha}}, siendo las {{$hora_inicio}} horas, el egresado de la 
        Escuela Profesional de Ingeniería de Sistemas <strong></strong>, defiende en sesión 
        pública el Informe Final de Prácticas Pre Profesionales titulado: <strong>{{$titulo}}</strong>
    </p>
    <p>
        ante el Jurado Evaluador, constituido por:
    </p>
    <p class="docentes">
        <strong>Presidente : </strong> {{$presidente}}
            <br>
        <strong>Secreatario : </strong> {{$secretario}} 
            <br>
        <strong>Vocal : </strong> {{$vocal}} 
    </p>
    <p>
        Procedió el estudiante a hacer la exposición del Informe Final de Prácticas Pre Profesionales, haciendo 
        especial mención en el diagnóstico, acciones propuestas, acciones realizadas, resultados obtenidos, 
        dificultades encontradas, conclusiones y recomendaciones. Terminada la defensa del informe final de 
        prácticas pre profesionales presentado, los miembros del Jurado Evaluador pasaron a exponer su opinión 
        sobre el mismo, formulado cuantas cuestiones y objeciones oportunas, las cuales fueron contestadas por 
        el aspirante.
    </p>
    <p>
        Tras la intervención de los miembros del Jurado Evaluador y las oportunas respuestas del estudiante, el 
        Presidente abre un turno de intervenciones para los presentes en el acto, a fin de que formulen las 
        cuestiones u objeciones que consideren pertinentes.
    </p>
    <p>
        Seguidamente, a puerta cerrada, el Jurado Evaluador determinó la calificación global del Informe Final de 
        Prácticas Pre Profesionales en términos de:
    </p>
    <p>
        En números: {{$nota_n}}, En Letras: {{$nota_l}} , siendo así: <strong>Aprobado</strong> (  ) <strong>Desaprobado</strong> ( )
    </p>
    <p>
        Otorgada la calificación el Secretario del Jurado Evaluador lee la presente Acta en sesión pública. A
        continuación, se levanta la sesión.
    </p>
    <p>
        Si el estudiante no aprobara la sustentación del Informe Final, tendrá una última oportunidad de sustentarlo 
        en un plazo no mayor de treinta (30) días posteriores a la primera sustentación.
    </p>
    <p>
        Siendo las <strong>{{$hora_fin}}</strong> horas del mismo día, el Jurado Evaluador concluye el acto de sustentación del Informe
        Final de Prácticas Pre Profesionales.
    
    <section>
        <div class="firma1">
             <span>-----------------------------------</span>
             <br>
             <span>PRESIDENTE</span>
             <br>
        </div>
        <div class="firma2">
            <span>-----------------------------------</span>
            <br>
            <span>SECRETARIO</span>
            <br>
        </div> 
        <div class="firma3">
            <span>-----------------------------------</span>
            <br>
            <span>VOCAL</span>
            <br>
        </div> 
        
     </section>
    <p>
        OBSERVACIONES
        <li class="obs">{{$observaciones}} </li>
    </p>
    
     
</body>
</html>
<?php

namespace Database\Seeders;

use App\Models\Estado;
use Illuminate\Database\Seeder;

class EstadoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $registros = [
            [
                'name' => 'No definido',
                'description' => 'Este estado significa que el proyecto aún no es evaluado, se debe esperar a la resolución de evaluación del proyecto de tesis.'
            ],
            [
                'name' => 'Aprobado',
                'description' => 'Este estado significa que el proyecto ya ha sido evaluado y aprobado, el tesista debe presentar en secretaría 
                un ejemplar del proyecto de Tesis Final, debidamente anillado y visado por los 3 miembros del
                jurado evaluador, asimismo, el tesista debe completar en la pestaña de seguimiento, todas las actividades de su cronograma, así como la
                asignación de una fecha inicial y final para el proyecto de Tesis. Si por algunas razón el tesista desea cambiar de tema, 
                tiene hasta 60 días para poder hacerlo, presentando el anexo (3G) de su carpeta, la resolución se puede descargar en la pestaña resoluciones
                del proyecto.'
            ],
            [
                'name' => 'Desaprobado',
                'description' => 'Este estado significa que el proyecto ha sido evaluado y desaprobado, el tesista debe reiniciar el proceso con la 
                presentación de un nuevo proyecto de tesis, con la misma carpeta de Tesis por última vez, la resolución se puede descargar en la pestaña resoluciones
                del proyecto.'
            ],
            [
                'name' => 'Caducado',
                'description' => 'Este estado significa que el proyecto no ha sido ejecutado en el plazo que se ha establecido, el tesista puedes 
                presentar por segunda y última vez un nuevo Proyecto de Tesis, con la misma Carpeta de Tesis, la resolución se puede descargar en la pestaña resoluciones
                del proyecto.'
            ],
            [
                'name' => 'Finalizado',
                'description' => 'Este estado significa que el proyecto ha sido ejecutado en el plazo establecido, a partir de este momento el tesista
                 debe presentar todos los documentos necesarios en su facultad para que pueda sustentar su Tesis.'
            ]
        ];

        foreach ($registros as $item) {
            Estado::create($item);
        }
    }
}

<?php

namespace Database\Seeders;

use App\Models\Etapa;
use Illuminate\Database\Seeder;

class EtapaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Etapa::insert([
            [
                'name' => 'Inicio',
                'description' => 'En esta etapa el tesista, ha adquirido su Carpeta de Tesis, y ha presentado en la secretaría de su facultad, 
                los documentos solicitados'
            ],
            [
                'name' => 'En evaluación',
                'description' => 'En esta etapa, el decano emite la resolución del jurado evaluador, este jurado evaluador 
                se encargará de evaluar el proyecto de tesis, se notificará al tesista para la sustentación de su proyecto, si hubierá levantamiento 
                de observaciones, el tesista deberá levantar estas obervaciones en el plazo que dicte su jurado evaluador'
            ],
            [
                'name' => 'En proceso',
                'description' => 'En esta etapa, el decano emite la resolución de evaluación del proyecto de tesis, ya sea aprobando o 
                desaprobando el proyecto de tesis, se notificará al tesista cuando salga esta resolución.'
            ],
            [
                'name' => 'En desarrollo',
                'description' => 'En esta etapa, el tesista se encuentra ejecutando cada una de sus actividades con ayuda de su asesor, el plazo mínimo es de
                 (04) meses y el plazo máximo es de (18) meses, prorrogable hasta (06) meses más'
            ],
            [
                'name' => 'Culminado',
                'description' => 'En esta etapa, la ejecución de la tesis ha finalizado, ya sea porque el tesista ha presentado sus documentos e informe final en secretaría
                 o porque el tiempo de ejecución ya se ha cumplido, si el tesista no cumple con el período establecido, el decano emite la 
                 resolución de caducidad del proyecto de tesis'
            ]

        ]);
    }
}

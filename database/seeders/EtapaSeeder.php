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
                'description' => 'El tesista ha comprado su carpeta de tesis y ha presentado sus documentos en secretaría'
            ],
            [
                'name' => 'En evaluación',
                'description' => 'La resolución asignando el jurado evaluador ya salió, el tesista deberá presentar al jurado su proyecto de tesis para su aprobación
                o rechazo, este etapa también incluye el levantamiento de observaciones'
            ],
            [
                'name' => 'En proceso',
                'description' => 'La resolución ya salió (aprobando ó desaprobando). El tesista deberá realizar su cronograma de actividades en el sistema y deberá hacer entrega en secretaría un ejemplar del proyecto de tesis, anillado y visado'
            ],
            [
                'name' => 'En desarrollo',
                'description' => 'El tesista esta desarrollando las actividades del cronograma'
            ],
            [
                'name' => 'Culminado',
                'description' => 'El tiempo para terminar la tesis ha concluido, y el tesista ya presentó su tesis'
            ]

        ]);
    }
}

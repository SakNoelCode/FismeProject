<?php

namespace Database\Seeders;

use App\Models\Tipoacta;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TipoactaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $registros = [
            [
                'descripcion' => 'solicitud dirigida al decano de la facultad'
            ],
            [
                'descripcion' => 'constancia de cursos aprobados hasta el VIII ciclo'
            ],
            [
                'descripcion' => 'plan de prácticas'
            ],
            [
                'descripcion' => 'carta de autorización emitida por la empresa'
            ],
            [
                'descripcion' => 'comprobante de pago por derecho de carta de presentación'
            ],
            [
                'descripcion' => 'resolución de prácticas'
            ],
            [
                'descripcion' => 'solicitud para la designación de jurado'
            ],
            [
                'descripcion' => 'resolución de informe final'
            ],
        ];

        foreach ($registros as $item) {
            Tipoacta::create($item);
        }
    }
}

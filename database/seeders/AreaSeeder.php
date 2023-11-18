<?php

namespace Database\Seeders;

use App\Models\Area;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AreaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $registros = [
            [
                'nombre' => 'Administración',
                'descripcion' => 'Area encargada de la administración'
            ],
            [
                'nombre' => 'Dayra',
                'descripcion' => 'Area encargada de la los estudiantes'
            ],
            [
                'nombre' => 'Decanato',
                'descripcion' => 'Area encargada de asuntos de la fisme'
            ],
            [
                'nombre' => 'Secretaría',
                'descripcion' => 'Area donde entran todos los documentos'
            ],
            [
                'nombre' => 'Recursos Humanos',
                'descripcion' => 'Sin descripción'
            ],
            [
                'nombre' => 'Dirección de escuela',
                'descripcion' => 'Sin descripción'
            ],
            [
                'nombre' => 'Dirección de departamento',
                'descripcion' => 'Sin descripción'
            ]
        ];

        foreach($registros as $item){
            Area::create($item);
        }
    }
}

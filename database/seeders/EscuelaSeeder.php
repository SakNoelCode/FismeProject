<?php

namespace Database\Seeders;

use App\Models\Escuela;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EscuelaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Escuela::insert([
            [
                'name' => 'Ingeniería de sistemas',
            ],
            [
                'name' => 'Mecánica eléctrica',
            ]
        ]);
    }
}

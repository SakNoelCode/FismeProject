<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Acta;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * php artisan make: seeder CursoSeeder -> creamos el curso
     * php atisan db:seed ->corremos el seeder
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(EscuelaSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(EtapaSeeder::class);
        $this->call(EstadoSeeder::class);
        $this->call(AreaSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(TipoactaSeeder::class);
    }
}

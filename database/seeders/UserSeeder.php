<?php

namespace Database\Seeders;

use App\Models\Practicante;
use App\Models\Secretaria;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Usuario administrador
        $userAdmin = User::create([
            'name' => 'Principal',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('12345678')
        ]);
        $userAdmin->assignRole('administrador');

        //Director de escuela
        $userDirector = User::create([
            'name' => 'Roberto Carlos Santa Cruz Acosta',
            'email' => 'director@untrm.edu.pe',
            'password' => bcrypt('12345678')
        ]);
        $userDirector->assignRole('director');

        //Secretaría
        $userSecretaria = User::create([
            'name' => 'Ederly Ramírez',
            'email' => 'fisme@untrm.edu.pe',
            'password' => bcrypt('12345678')
        ]);
        $userSecretaria->assignRole('secretaria');
        Secretaria::create([
            'cargo' => 'Principal',
            'escuela_id' => 1,
            'user_id' => $userSecretaria->id,
            'area_id' => 4
        ]);
    }
}

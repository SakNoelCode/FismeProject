<?php

namespace Database\Seeders;

use App\Models\Asesor;
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

        //Asesores
        $userAsesor1 = User::create([
            'name' => 'Iván Adrianzén',
            'email' => 'ivan@untrm.edu.pe',
            'password' => bcrypt('12345678')
        ]);
        $userAsesor1->assignRole('asesor');
        Asesor::create([
            'especialidad' => 'Redes',
            'escuela_id' => 1,
            'user_id' => $userAsesor1->id
        ]);

        $userAsesor2 = User::create([
            'name' => 'Eder Figueroa',
            'email' => 'eder@untrm.edu.pe',
            'password' => bcrypt('12345678')
        ]);
        $userAsesor2->assignRole('asesor');
        Asesor::create([
            'especialidad' => 'Redes',
            'escuela_id' => 1,
            'user_id' => $userAsesor2->id
        ]);

        $userAsesor3 = User::create([
            'name' => 'Lobatón Arenas',
            'email' => 'lobaton@untrm.edu.pe',
            'password' => bcrypt('12345678')
        ]);
        $userAsesor3->assignRole('asesor');
        Asesor::create([
            'especialidad' => 'Redes',
            'escuela_id' => 1,
            'user_id' => $userAsesor3->id
        ]);

        $userAsesor4 = User::create([
            'name' => 'Roberto Astonitas',
            'email' => 'roberto@untrm.edu.pe',
            'password' => bcrypt('12345678')
        ]);
        $userAsesor4->assignRole('asesor');
        Asesor::create([
            'especialidad' => 'Redes',
            'escuela_id' => 1,
            'user_id' => $userAsesor4->id
        ]);

        $userAsesor5 = User::create([
            'name' => 'Angelo Becerril',
            'email' => 'angelo@untrm.edu.pe',
            'password' => bcrypt('12345678')
        ]);
        $userAsesor5->assignRole('asesor');
        Asesor::create([
            'especialidad' => 'Redes',
            'escuela_id' => 1,
            'user_id' => $userAsesor5->id
        ]);
    }
}

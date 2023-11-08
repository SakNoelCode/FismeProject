<?php

namespace Database\Seeders;

use App\Models\Practicante;
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

         //Practicante
         $userPracticante = User::create([
            'name' => 'Eusebio Bustamante',
            'email' => 'eusebio@untrm.edu.pe',
            'password' => bcrypt('12345678')
        ]);
        $userPracticante->assignRole('practicante');
        Practicante::create([
            'user_id' => $userPracticante->id
        ]);

        
    }
}

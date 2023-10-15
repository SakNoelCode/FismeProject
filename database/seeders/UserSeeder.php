<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         //Usuario administrador
        $user = User::create([
            'name' => 'Principal',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('12345678')
        ]);      
        $user->assignRole('administrador');

        //Director de escuela
        $user = User::create([
            'name' => 'Roberto Carlos Santa Cruz Acosta',
            'email' => 'director@untrm.edu.pe',
            'password' => bcrypt('12345678')
        ]);
        $user->assignRole('director');
    }
}

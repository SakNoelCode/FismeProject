<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::insert([
            [
                'name' => 'tesista',
                'guard_name' => 'web'
            ],
            [
                'name' => 'secretaria',
                'guard_name' => 'web'
            ],
            [
                'name' => 'asesor',
                'guard_name' => 'web'
            ]
        ]);
    }
}

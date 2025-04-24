<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
Use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User:: create([
            'name' => 'AdmTeste',
            'email' => 'adm@email.com',
            'password' => Hash::make('123456'),
            'role' => 'ADM'
        ]);

        User:: create([
            'name' => 'CliTeste',
            'email' => 'cli@email.com',
            'password' => Hash::make('123456'),
            'role' => 'CLI'
        ]);

        User:: create([
            'name' => 'Ana',
            'email' => 'ana@email.com',
            'password' => Hash::make('123456'),
            'role' => 'CLI'
        ]);
    }
}

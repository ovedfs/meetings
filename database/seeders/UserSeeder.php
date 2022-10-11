<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Abogado Admin',
            'email' => 'abogado.admin@gmail.com',
            'password' => Hash::make('password'),
        ])->assignRole('abogado admin');

        User::create([
            'name' => 'abogado1',
            'email' => 'abogado1@gmail.com',
            'password' => Hash::make('password'),
        ])->assignRole('abogado');

        User::create([
            'name' => 'abogado2',
            'email' => 'abogado2@gmail.com',
            'password' => Hash::make('password'),
        ])->assignRole('abogado');

        User::create([
            'name' => 'abogado3',
            'email' => 'abogado3@gmail.com',
            'password' => Hash::make('password'),
        ])->assignRole('abogado');

        User::create([
            'name' => 'arrendador1',
            'email' => 'arrendador1@gmail.com',
            'password' => Hash::make('password'),
        ])->assignRole('arrendador');

        User::create([
            'name' => 'arrendador2',
            'email' => 'arrendador2@gmail.com',
            'password' => Hash::make('password'),
        ])->assignRole('arrendador');

        User::create([
            'name' => 'arrendatario1',
            'email' => 'arrendatario1@gmail.com',
            'password' => Hash::make('password'),
        ])->assignRole('arrendatario');

        User::create([
            'name' => 'arrendatario2',
            'email' => 'arrendatario2@gmail.com',
            'password' => Hash::make('password'),
        ])->assignRole('arrendatario');

        User::create([
            'name' => 'solidario1',
            'email' => 'solidario1@gmail.com',
            'password' => Hash::make('password'),
        ])->assignRole('solidario');

        User::create([
            'name' => 'fiador1',
            'email' => 'fiador1@gmail.com',
            'password' => Hash::make('password'),
        ])->assignRole('fiador');
    }
}

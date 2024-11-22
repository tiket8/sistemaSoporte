<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User; // Asegúrate de importar el modelo correcto
use Illuminate\Support\Facades\Hash; // Para encriptar la contraseña

class SoporteAdministradorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Crear un usuario con rol "soporte" y administrador
        User::create([
            'nombre' => 'Administrador',
            'apellido' => 'Soporte',
            'email' => 'admin@soporte.com',
            'password' => Hash::make('password123'), 
            'rol' => 'soporte', 
        ]);
    }
}


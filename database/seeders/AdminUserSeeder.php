<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Crear roles
        Role::firstOrCreate(['name' => 'admin']);
        Role::firstOrCreate(['name' => 'client']);

        // Crear usuario administrador
        $adminUser = User::firstOrCreate(
            ['email' => 'admin@admin.com'], // Condición para buscar el usuario
            [
                'name' => 'Admin User',
                'password' => Hash::make('admin'), // Asegúrate de usar un hash seguro
            ]
        );

        // Asignar rol de administrador al usuario
        if (!$adminUser->hasRole('admin')) {
            $adminUser->assignRole('admin');
        }


    }
}

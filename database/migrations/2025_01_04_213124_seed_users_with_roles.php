<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use App\Models\User;
use Spatie\Permission\Models\Role;

class SeedUsersWithRoles extends Migration
{
    public function up()
    {
        // Dodanie użytkownika admin, jeśli nie istnieje
        $admin = User::where('email', 'admin@gmail.com')->first();
        if (!$admin) {
            $admin = User::create([
                'name' => 'admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('admin')
            ]);
            $adminRole = Role::findByName('Admin');
            $admin->assignRole($adminRole);
        }

        // Dodanie użytkownika pracownik, jeśli nie istnieje
        $worker = User::where('email', 'pracownik1@gmail.com')->first();
        if (!$worker) {
            $worker = User::create([
                'name' => 'pracownik1',
                'email' => 'pracownik1@gmail.com',
                'password' => Hash::make('Abc123456789!')
            ]);
            $workerRole = Role::findByName('Worker');
            $worker->assignRole($workerRole);
        }

        // Dodanie użytkownika klient, jeśli nie istnieje
        $client = User::where('email', 'a@gmail.com')->first();
        if (!$client) {
            $client = User::create([
                'name' => 'klient',
                'email' => 'a@gmail.com',
                'password' => Hash::make('Abc123456789!')
            ]);
            $clientRole = Role::findByName('User');
            $client->assignRole($clientRole);
        }
    }

    public function down()
    {
        // Usunięcie użytkowników podczas rollbacka migracji
        User::whereIn('email', ['admin@gmail.com', 'pracownik1@gmail.com', 'a@gmail.com'])->delete();
    }
}
<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Role;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Usuwanie istniejącego użytkownika jeśli już istnieje, aby uniknąć duplikatów
        $userEmail = 'test@example.com';
        User::where('email', $userEmail)->delete();

        // Tworzenie pojedynczego użytkownika testowego
        $user = User::factory()->create([
            'name' => 'Test User',
            'email' => $userEmail,
        ]);

        // Tworzenie lub aktualizacja ról z domyślną nazwą strażnika
        Role::updateOrCreate(['name' => 'Admin'], ['guard_name' => 'web']);
        Role::updateOrCreate(['name' => 'User'], ['guard_name' => 'web']);
        Role::updateOrCreate(['name' => 'Worker'], ['guard_name' => 'web']);  // Dodanie roli "Worker"

        // Zakładając, że istnieje metoda przypisywania ról użytkownikowi
        $adminRole = Role::where('name', 'Admin')->first();
        $workerRole = Role::where('name', 'Worker')->first();  // Pobieranie roli "Worker"

        // Przypisywanie roli do użytkownika
        $user->assignRole($adminRole);
        $user->assignRole($workerRole);  // Dodawanie roli "Worker" do użytkownika

        // Dodatkowa niestandardowa logika seedowania tutaj
    }
}

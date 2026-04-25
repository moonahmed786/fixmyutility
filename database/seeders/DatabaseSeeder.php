<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        // Create roles
        foreach (['admin', 'editor', 'customer'] as $role) {
            Role::firstOrCreate(['name' => $role, 'guard_name' => 'web']);
        }

        // Admin user
        $admin = User::updateOrCreate(
            ['email' => 'admin@fixmyutility.com'],
            [
                'name'              => 'Admin User',
                'password'          => bcrypt('password'),
                'country'           => 'US',
                'currency'          => 'USD',
                'email_verified_at' => now(),
            ]
        );
        $admin->syncRoles(['admin']);

        // Demo customer
        $customer = User::updateOrCreate(
            ['email' => 'demo@fixmyutility.com'],
            [
                'name'              => 'Demo Customer',
                'password'          => bcrypt('password'),
                'country'           => 'US',
                'currency'          => 'USD',
                'email_verified_at' => now(),
            ]
        );
        $customer->syncRoles(['customer']);

        $this->call([AppSeeder::class]);
    }
}

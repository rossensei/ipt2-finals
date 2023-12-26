<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user1 = User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => 'password',
            'email_verified_at' => now(),
        ]);

        $user2 = User::create([
            'name' => 'User',
            'email' => 'user@gmail.com',
            'password' => 'password',
            'email_verified_at' => now(),
        ]);


        $admin = Role::create(['name' => 'admin']);
        $user = Role::create(['name' => 'user']);

        $user1->assignRole($admin);
        $user2->assignRole($user);
    }
}

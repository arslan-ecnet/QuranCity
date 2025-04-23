<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
        $userRole = Role::create(['name' => 'admin']);
        $superAdminRole = Role::create(['name' => 'user']);

        $user = User::where('email', 'admin@gmail.com')->first()->assignRole('admin');
    }
}

<?php

namespace Database\Seeders;

use App\Models\ProcedureTemplate;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $allPermissions = Permission::pluck('name')->toArray();
        $role = Role::findById(1);
        $role->givePermissionTo($allPermissions);
    }
}

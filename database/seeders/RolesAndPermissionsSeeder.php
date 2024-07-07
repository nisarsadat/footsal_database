<?php

namespace Database\Seeders;

namespace Database\Seeders;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;



use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {

         // Create permissions
         Permission::create(['name' => 'view customers']);
         Permission::create(['name' => 'create customers']);
         Permission::create(['name' => 'edit customers']);
         Permission::create(['name' => 'delete customers']);

         // Create roles and assign existing permissions
         $role = Role::create(['name' => 'admin']);
         $role->givePermissionTo(Permission::all());



        // Create permissions
         // Create permissions
        //  Permission::create(['name' => 'view articles']);
        //  Permission::create(['name' => 'create articles']);
        //  Permission::create(['name' => 'edit articles']);
        //  Permission::create(['name' => 'delete articles']);

        //  // Create roles and assign existing permissions
        //  $role = Role::create(['name' => 'writer']);
        //  $role->givePermissionTo('view articles');
        //  $role->givePermissionTo('create articles');
        //  $role->givePermissionTo('edit articles');
        //  $role->givePermissionTo('delete articles');

        //  $role = Role::create(['name' => 'admin']);
        //  $role->givePermissionTo(Permission::all());
        //
    }
}

<?php

use Illuminate\Database\Seeder;

class RoleTableSeedeer extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

         \Spatie\Permission\Models\Role::create(['name' =>'Super-Admin' ]);


    }
}

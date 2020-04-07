<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        \App\User::truncate();

        $adminrole=\Spatie\Permission\Models\Role::where('name',  'Super-Admin')->first();


        $admin=\App\User::create([

            'name'=>'The King',
            'email'=>'admin@admin.com',
            'password'=> \Illuminate\Support\Facades\Hash::make('password'),
        ]);

        $admin->assignRole($adminrole);



    }
}

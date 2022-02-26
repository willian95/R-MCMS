<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(Role::where("id", 1)->count() == 0){

            $role = new Role;
            $role->id = 1;
            $role->name = "superadmin";
            $role->save();

        }

        if(Role::where("id", 2)->count() == 0){

            $role = new Role;
            $role->id = 2;
            $role->name = "user";
            $role->save();

        }

        if(Role::where("id", 3)->count() == 0){

            $role = new Role;
            $role->id = 3;
            $role->name = "admin";
            $role->save();

        }
    }
}

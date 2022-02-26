<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(User::where("id", 1)->count() == 0){

            $user = new User;
            $user->id = 1;
            $user->name = "admin";
            $user->email  = "admin@gmail.com";
            $user->password = bcrypt("12345678");
            $user->role_id = 1;
            $user->save();

        }

        if(User::where("id", 2)->count() == 0){

            $user = new User;
            $user->id = 2;
            $user->name = "jefe de compras";
            $user->email  = "jefecompras@gmail.com";
            $user->password = bcrypt("12345678");
            $user->role_id = 3;
            $user->save();

        }
    }
}

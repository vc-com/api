<?php

use App\Entities\Role;
use App\Entities\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{


//https://github.com/jenssegers/laravel-mongodb/issues/1347
//https://github.com/jenssegers/laravel-mongodb/issues/1271

    public function run()
    {

        $this->generateUser(Role::ADMIN);
        $this->generateUser(Role::STAFF_FINANCE);
    }

    private function generateUser($typeRole)
    {

        $users = factory(User::class,2)->create();
        
        $users->each(function ($user) use($typeRole) {

            $role = Role::where('name', $typeRole)->first();
            $user->roles()->attach($role);

        });

    }

}

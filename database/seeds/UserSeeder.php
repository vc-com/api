<?php

use VoceCrianca\Models\Role;
use VoceCrianca\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{


//https://github.com/jenssegers/laravel-mongodb/issues/1347
//https://github.com/jenssegers/laravel-mongodb/issues/1271

    public function run()
    {

        foreach (Role::DATA_ROLES as $data) {
            $this->generateUser($data['name']);
        }
        
    }

    private function generateUser($type)
    {

        $users = factory(User::class,rand(1,100))->create();
        
        $users->each(function ($user) use($type) {

            $role = Role::where('name', $type)->first();
            $user->roles()->attach($role);

        });

    }

}

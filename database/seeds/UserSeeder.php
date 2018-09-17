<?php

use App\Entities\Role;
use App\Entities\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{

    public function run()
    {

        $this->generateUser(Role::ADMIN);
        $this->generateUser(Role::STAFF_AUDIT);
        $this->generateUser(Role::STAFF_COMMERCIAL);
        $this->generateUser(Role::STAFF_SUPPORT);
        $this->generateUser(Role::STAFF_FINANCE);
    }

    private function generateUser($typeRole)
    {

        $users = factory(User::class,2)->create();
        
        $users->each(function ($user) use($typeRole) {

            $roleFirst = Role::where('name', $typeRole)->first();

            $role = $user->roles()->create([
                'name' => $roleFirst->name,
                'role_id' => $roleFirst->id,
            ]);

            $rolesAll = Role::where('name', $typeRole)->get();

            foreach ($rolesAll as $item) {

                foreach ($item->privileges as $privilege) {

                    $user->privileges()->create([
                        'role_id' => $role->id,
                        'name' => $privilege->name
                    ]);

                }

            }

        });

    }

}

<?php

namespace App\Observers;


use App\Entities\Privilege;
use App\Entities\Role;
use App\Entities\RoleUser;
use App\Entities\User;

class RoleUserObserver
{

    public function created(User $user)
    {


        // if($user->isAdmin === User::ADMIN_USER) {

        //     $role = Role::where('name', Role::ADMIN_STAFF_INITIAL)->first();

        //     $privileges = [];
        //     foreach ($role->privileges as $privilege) {
        //         array_push($privileges, $privilege->name);
        //     }

        //     $role_user->roleUser()->create([
        //         'name' => $role->name,
        //         'privileges' => $privileges
        //     ]);

        // }

    }

}

<?php

use VoceCrianca\Models\Privilege;
use Illuminate\Database\Seeder;
use VoceCrianca\Models\Role;

class RoleSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @throws Exception
     */
    public function run()
    {

        foreach (Role::DATA_ROLES as $data) {
            if (Role::where('name', $data['name'])->count() <= 0) {
                $this->createRoles($data);
            }

        }

    }

    /**
     * @param $data
     * @throws Exception
     */
    private function createRoles($data)
    {
        $role = Role::create([
            'name' => $data['name'],
            'description' => $data['description'],
            'default' => true
        ]);

        if( $data['name'] === 'ADMIN' ) {

            $all = Privilege::where('name', Privilege::ALL)->first();
            $role->privileges()->create([
                'name' => $all->name,
                'description' => $all->description,
            ]);

        } else {

            $read    = Privilege::where('name', Privilege::READ)->first();
            $add     = Privilege::where('name', Privilege::ADD)->first();
            $edit    = Privilege::where('name', Privilege::EDIT)->first();
            $delete  = Privilege::where('name', Privilege::DELETE)->first();

            $role->privileges()->create([
                'name' => $read->name,
                'description' => $read->description,
            ]);

            switch ($data['name']) {

                case Role::STAFF_AUDITOR:
                case Role::STAFF_FINANCE:
                case Role::STAFF_COMMERCIAL:
                case Role::STAFF_SUPPORT:
                case Role::STAFF_SALE:
                case Role::STAFF_EDITOR:
                case Role::STAFF_EXPEDITION:   

                    $role->privileges()->create([
                        'name' => $add->name,
                        'description' => $add->description,
                    ]);

                    $role->privileges()->create([
                        'name' => $edit->name,
                        'description' => $edit->description,
                    ]);

                    break;

                default:

                    break;
            }

            switch ($data['name']) {

                case Role::STAFF_FINANCE:
                case Role::STAFF_COMMERCIAL:
                case Role::STAFF_SUPPORT:
                case Role::STAFF_SALE:
                case Role::STAFF_EDITOR:

                    $role->privileges()->create([
                        'name' => $delete->name,
                        'description' => $delete->description,
                    ]);

                    break;
                
                default:
                
                    break;
            }

        }

    }
 

}

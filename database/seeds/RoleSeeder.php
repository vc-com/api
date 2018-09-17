<?php

use App\Entities\Privilege;
use Illuminate\Database\Seeder;
use App\Entities\Role;

class RoleSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @throws Exception
     */
    public function run()
    {

        foreach ($this->dataRoles() as $data) {

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

        if( $data['name'] === Role::ADMIN ) {

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

                case Role::STAFF_AUDIT:
                case Role::STAFF_SUPPORT:
                case Role::STAFF_FINANCE:
                case Role::STAFF_COMMERCIAL:
                case Role::STAFF_EDITOR:
                case Role::STAFF_EXPEDITION:
                case Role::STAFF_PARTNER:
            

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

                case Role::STAFF_AUDIT:
                case Role::STAFF_FINANCE:
                case Role::STAFF_EDITOR:
                case Role::STAFF_PARTNER:

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

    public function dataRoles()
    {
        return [
            [
                'name' => Role::ADMIN,
                'description' => 'Administrador Geral',
            ],
            [
                'name' => Role::STAFF_AUDIT,
                'description' => 'Departamento de Auditoria',
            ],
            [
                'name' => Role::STAFF_FINANCE,
                'description' => 'Departamento Financeiro',
            ],
            [
                'name' => Role::STAFF_COMMERCIAL,
                'description' => 'Departamento Comercial',
            ],
            [
                'name' => Role::STAFF_SUPPORT,
                'description' => 'Departamento de Suporte',
            ],
            [
                'name' => Role::STAFF_EDITOR,
                'description' => 'Editor',
            ],
            [
                'name' => Role::STAFF_EXPEDITION,
                'description' => 'Expedição',
            ],
            [
                'name' => Role::STAFF_PARTNER,
                'description' => 'Parceiro',
            ],

        ];

    }

}

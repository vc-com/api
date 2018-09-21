<?php

use Illuminate\Database\Seeder;
use App\Entities\Privilege;

class PrivilegeSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @throws Exception
     */
    public function run()
    {

        foreach ($this->dataPrivileges() as $data) {

            Privilege::create([
                'name' => $data['name'],
                'description' => $data['description'],
            ]);

        }

    }

    private function dataPrivileges()
    {
        return [

            [
                'name' => Privilege::ALL,
                'description' => 'Todos',
            ],
            [
                'name' => Privilege::READ,
                'description' => 'Pode Ler',
            ],
            [
                'name' => Privilege::ADD,
                'description' => 'Pode Adicionar'
            ],
            [
                'name' => Privilege::EDIT,
                'description' => 'Pode Editar'
            ],
            [
                'name' => Privilege::DELETE,
                'description' => 'Pode Deletar'
            ]

        ];

    }

}

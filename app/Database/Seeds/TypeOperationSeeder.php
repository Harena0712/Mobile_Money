<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class TypeOperationSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'libelle' => 'DEPOT',
                'actif' => 1
            ],
            [
                'libelle' => 'RETRAIT',
                'actif' => 1
            ],
            [
                'libelle' => 'TRANSFERT',
                'actif' => 1
            ]
        ];

        $this->db->table('TypeOperation')->insertBatch($data);
    }
}
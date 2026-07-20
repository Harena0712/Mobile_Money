<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ClientSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'telephone' => '0331234567',
                'actif' => 1
            ],
            [
                'telephone' => '0349876543',
                'actif' => 1
            ],
            [
                'telephone' => '0374567890',
                'actif' => 1
            ],
            [
                'telephone' => '0381122334',
                'actif' => 1
            ]
        ];

        $this->db->table('Client')->insertBatch($data);
    }
}
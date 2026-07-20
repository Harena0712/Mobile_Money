<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class TypeOperationSeeder extends Seeder
{
    public function run()
    {
        $table = $this->db->table('TypeOperation');
        $existing = array_column($table->select('libelle')->get()->getResultArray(), 'libelle');

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

        $insert = array_filter($data, function ($row) use ($existing) {
            return ! in_array($row['libelle'], $existing, true);
        });

        if (! empty($insert)) {
            $table->insertBatch($insert);
        }
    }
}
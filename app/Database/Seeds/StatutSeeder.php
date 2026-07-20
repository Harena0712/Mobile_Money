<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class StatutSeeder extends Seeder
{
    public function run()
    {
        $table = $this->db->table('Statut');
        $existing = array_column($table->select('libelle')->get()->getResultArray(), 'libelle');

        $data = [
            ['libelle' => 'EN_ATTENTE'],
            ['libelle' => 'SUCCES'],
            ['libelle' => 'ECHEC']
        ];

        $insert = array_filter($data, function ($row) use ($existing) {
            return ! in_array($row['libelle'], $existing, true);
        });

        if (! empty($insert)) {
            $table->insertBatch($insert);
        }
    }
}
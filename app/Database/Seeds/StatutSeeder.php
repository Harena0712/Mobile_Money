<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class StatutSeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['libelle' => 'EN_ATTENTE'],
            ['libelle' => 'SUCCES'],
            ['libelle' => 'ECHEC']
        ];

        $this->db->table('Statut')->insertBatch($data);
    }
}
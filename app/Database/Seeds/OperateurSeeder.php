<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class OperateurSeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['libelle' => 'Orange', 'actif' => 1],
            ['libelle' => 'Yas', 'actif' => 1],
            ['libelle' => 'Airtel', 'actif' => 1],
        ];

        $this->db->table('Operateur')->insertBatch($data);
    }
}

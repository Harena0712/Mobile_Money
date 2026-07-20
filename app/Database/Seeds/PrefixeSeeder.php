<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PrefixeSeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['prefixe' => '033', 'actif' => 1],
            ['prefixe' => '037', 'actif' => 1],
        ];

        $this->db->table('Prefixe')->insertBatch($data);
    }
}
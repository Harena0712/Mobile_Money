<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PrefixeSeeder extends Seeder
{
    public function run()
    {

    
        $operatorIds = [];
        foreach (['Orange', 'Yas', 'Airtel'] as $libelle) {
            $operator = $this->db->table('Operateur')->where('libelle', $libelle)->get()->getRowArray();
            if ($operator) {
                $operatorIds[$libelle] = (int) $operator['id'];
            }
        }

        $existing = $this->db->table('Prefixe')->select('prefixe')->get()->getResultArray();
        $existingPrefixes = array_column($existing, 'prefixe');

        $data = [];
        foreach ([
            ['prefixe' => '033', 'actif' => 1, 'id_operateur' => $operatorIds['Airtel'] ?? 0],
            ['prefixe' => '037', 'actif' => 1, 'id_operateur' => $operatorIds['Airtel'] ?? 0],
            ['prefixe' => '034', 'actif' => 1, 'id_operateur' => $operatorIds['Yas'] ?? 0],
            ['prefixe' => '038', 'actif' => 1, 'id_operateur' => $operatorIds['Yas'] ?? 0],
            ['prefixe' => '032', 'actif' => 1, 'id_operateur' => $operatorIds['Orange'] ?? 0],
            ['prefixe' => '031', 'actif' => 1, 'id_operateur' => $operatorIds['Orange'] ?? 0],

        ] as $prefix) {
            if (!in_array($prefix['prefixe'], $existingPrefixes, true)) {
                $data[] = $prefix;
            }
        }

        if (!empty($data)) {
            $this->db->table('Prefixe')->insertBatch($data);
        }
    }
}

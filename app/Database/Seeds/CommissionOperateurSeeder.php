<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class CommissionOperateurSeeder extends Seeder
{
    public function run()
    {

        $this->call('TypeOperationSeeder');
        $operatorIds = [];
        foreach (['Orange', 'Yas', 'Airtel'] as $libelle) {
            $operator = $this->db->table('Operateur')->where('libelle', $libelle)->get()->getRowArray();
            if ($operator) {
                $operatorIds[$libelle] = (int) $operator['id'];
            }
        }

        $data = [];

        if (!empty($operatorIds['Orange']) && !empty($operatorIds['Yas'])) {
            $data[] = [
                'id_operateur_source' => $operatorIds['Orange'],
                'id_operateur_destination' => $operatorIds['Yas'],
                'pourcentage' => 2.5,
            ];
        }

        if (!empty($operatorIds['Yas']) && !empty($operatorIds['Airtel'])) {
            $data[] = [
                'id_operateur_source' => $operatorIds['Yas'],
                'id_operateur_destination' => $operatorIds['Airtel'],
                'pourcentage' => 2.0,
            ];
        }

        if (!empty($operatorIds['Airtel']) && !empty($operatorIds['Orange'])) {
            $data[] = [
                'id_operateur_source' => $operatorIds['Airtel'],
                'id_operateur_destination' => $operatorIds['Orange'],
                'pourcentage' => 3.0,
            ];
        }

        if (!empty($data)) {
            $this->db->table('CommissionOperateur')->insertBatch($data);
        }
    }
}

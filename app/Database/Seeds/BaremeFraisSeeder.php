<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class BaremeFraisSeeder extends Seeder
{
    public function run()
    {
        $this->call('TypeOperationSeeder');
        $types = [2,3];

        $baremes = [
            [100,1000,50],
            [1001,5000,50],
            [5001,10000,100],
            [10001,25000,200],
            [25001,50000,400],
            [50001,100000,800],
            [100001,250000,1500],
            [250001,500000,1500],
            [500001,1000000,2500],
            [1000001,2000000,3000]
        ];

        $table = $this->db->table('BaremeFrais');

        foreach ($types as $type) {
            foreach ($baremes as $b) {
                $exists = $table
                    ->where('id_type_operation', $type)
                    ->where('montant_min', $b[0])
                    ->where('montant_max', $b[1])
                    ->get()
                    ->getRowArray();

                if (empty($exists)) {
                    $table->insert([
                        'id_type_operation' => $type,
                        'montant_min' => $b[0],
                        'montant_max' => $b[1],
                        'valeur' => $b[2]
                    ]);
                }
            }
        }
    }
}
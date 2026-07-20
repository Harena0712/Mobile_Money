<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class TransactionSeeder extends Seeder
{
    public function run()
    {
        $data = [

            [
                'id_type_operation'=>1,
                'id_client_source'=>null,
                'id_client_destination'=>1,
                'montant'=>100000,
                'frais'=>0,
                'id_statut'=>2
            ],

            [
                'id_type_operation'=>2,
                'id_client_source'=>1,
                'id_client_destination'=>null,
                'montant'=>20000,
                'frais'=>200,
                'id_statut'=>2
            ],

            [
                'id_type_operation'=>3,
                'id_client_source'=>1,
                'id_client_destination'=>2,
                'montant'=>30000,
                'frais'=>400,
                'id_statut'=>2
            ]

        ];

        $this->db->table('Transaction')->insertBatch($data);
    }
}
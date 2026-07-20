<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class MouvementCompteSeeder extends Seeder
{
    public function run()
    {
        $this->call('TransactionSeeder');

        $data = [
            [
                'id_transaction'=>1,
                'id_client'=>1,
                'montant'=>100000,
                'sens'=>'CREDIT'
            ],

            [
                'id_transaction'=>2,
                'id_client'=>1,
                'montant'=>20200,
                'sens'=>'DEBIT'
            ],

            [
                'id_transaction'=>3,
                'id_client'=>1,
                'montant'=>30400,
                'sens'=>'DEBIT'
            ],

            [
                'id_transaction'=>3,
                'id_client'=>2,
                'montant'=>30000,
                'sens'=>'CREDIT'
            ]

        ];

        $this->db->table('MouvementCompte')->insertBatch($data);
    }
}
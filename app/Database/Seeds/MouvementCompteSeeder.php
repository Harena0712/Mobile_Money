<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class MouvementCompteSeeder extends Seeder
{
    public function run()
    {
        $data = [

            // Dépôt
            [
                'transaction_id'=>1,
                'client_id'=>1,
                'montant'=>100000,
                'sens'=>'CREDIT'
            ],

            // Retrait
            [
                'transaction_id'=>2,
                'client_id'=>1,
                'montant'=>20200,
                'sens'=>'DEBIT'
            ],

            // Transfert : débit
            [
                'transaction_id'=>3,
                'client_id'=>1,
                'montant'=>30400,
                'sens'=>'DEBIT'
            ],

            // Transfert : crédit
            [
                'transaction_id'=>3,
                'client_id'=>2,
                'montant'=>30000,
                'sens'=>'CREDIT'
            ]

        ];

        $this->db->table('MouvementCompte')->insertBatch($data);
    }
}
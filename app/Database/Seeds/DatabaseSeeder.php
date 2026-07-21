<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call('OperateurSeeder');
        $this->call('TypeOperationSeeder');
        $this->call('StatutSeeder');
        $this->call('PrefixeSeeder');
        $this->call('CommissionOperateurSeeder');
        $this->call('BaremeFraisSeeder');
        $this->call('ClientSeeder');
        $this->call('MouvementCompteSeeder');
        $this->call('TransactionSeeder');
    }
}
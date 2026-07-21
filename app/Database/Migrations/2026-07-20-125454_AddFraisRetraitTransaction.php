<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddFraisRetraitTransaction extends Migration
{
    public function up()
    {
        $this->forge->addColumn('Transactions', [
            'inclure_frais_retrait' => ['type' => 'DECIMAL(10,2)'],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('Transactions', 'inclure_frais_retrait');
    }
}

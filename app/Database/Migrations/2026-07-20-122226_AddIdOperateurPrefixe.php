<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddIdOperateurPrefixe extends Migration
{
    public function up()
    {
        $this->forge->addColumn('Prefixe', [
            'id_operateur' => ['type' => 'INTEGER', 'default' => 0],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('Prefixe', 'id_operateur');
    }
}

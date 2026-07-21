<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateEpargneClient extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INTEGER',
                'auto_increment' => true,
            ],
            'idClient' => [
                'type' => 'INTEGER',
                'null' => false,
            ],
            'montantEpargne' => [
                'type'       => 'DECIMAL',
                'constraint' => '5,2',
                'null' => false,
            ],
        ]);

        $this->forge->createTable('EpargneClient');
    }

    public function down()
    {
        $this->forge->dropTable('EpargneClient', true);
        
    }
}

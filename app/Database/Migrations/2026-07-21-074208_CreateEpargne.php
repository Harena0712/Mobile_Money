<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateEpargne extends Migration
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
            'pourcentageEpargne' => [
                'type'       => 'DECIMAL',
                'constraint' => '5,2',
                'null' => false,
            ],
        ]);

        $this->forge->createTable('Epargne');
    }

    public function down()
    {
        $this->forge->dropTable('Epargne', true);
        
    }
}

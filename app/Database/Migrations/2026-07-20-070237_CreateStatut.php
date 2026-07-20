<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateStatut extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INTEGER',
                'auto_increment' => true,
            ],
            'libelle' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'unique'     => true,
            ],
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('Statut');
    }

    public function down()
    {
        $this->forge->dropTable('Statut');
    }
}
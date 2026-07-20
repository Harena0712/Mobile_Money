<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTypeOperation extends Migration
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
            'actif' => [
                'type'    => 'INTEGER',
                'default' => 1,
            ],
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('TypeOperation');
    }

    public function down()
    {
        $this->forge->dropTable('TypeOperation');
    }
}
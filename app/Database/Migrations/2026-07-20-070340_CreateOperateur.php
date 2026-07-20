<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateOperateur extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INTEGER',
                'auto_increment' => true,
            ],
            'libelle' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => false,
            ],
            'actif' => [
                'type'    => 'INTEGER',
                'default' => 1,
            ],
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('Operateur');
    }

    public function down()
    {
        $this->forge->dropTable('Operateur', true);
    }
}

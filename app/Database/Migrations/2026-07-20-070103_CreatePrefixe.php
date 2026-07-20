<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePrefixe extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INTEGER',
                'auto_increment' => true,
            ],
            'prefixe' => [
                'type'       => 'VARCHAR',
                'constraint' => 10,
                'unique'     => true,
            ],
            'actif' => [
                'type'       => 'INTEGER',
                'default'    => 1,
            ],
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('Prefixe');
    }

    public function down()
    {
        $this->forge->dropTable('Prefixe');
    }
}
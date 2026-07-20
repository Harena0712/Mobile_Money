<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateClient extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INTEGER',
                'auto_increment' => true,
            ],
            'telephone' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
                'unique'     => true,
            ],
            'date_creation' => [
                'type'    => 'DATE',
                'default' => 'CURRENT_DATE',
            ],
            'actif' => [
                'type'    => 'INTEGER',
                'default' => 1,
            ],
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('Client');
    }

    public function down()
    {
        $this->forge->dropTable('Client');
    }
}
<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePromotion extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INTEGER',
                'auto_increment' => true,
            ],
            'prommotion' => [
                'type' => 'INTEGER',
                'null' => false,
            ],
        ]);

        $this->forge->createTable('Promotion');
    }

    public function down()
    {
        $this->forge->dropTable('Promotion', true);
    }
}

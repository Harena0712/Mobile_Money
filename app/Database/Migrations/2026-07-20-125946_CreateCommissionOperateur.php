<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateCommissionOperateur extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INTEGER',
                'auto_increment' => true,
            ],
            'id_operateur_source' => [
                'type' => 'INTEGER',
                'null' => false,
            ],
            'id_operateur_destination' => [
                'type' => 'INTEGER',
                'null' => false,
            ],
            'pourcentage' => [
                'type'       => 'DECIMAL',
                'constraint' => '5,2',
                'null'       => false,
            ],
        ]);

        $this->forge->addKey('id', true);

        $this->forge->addForeignKey(
            'id_operateur_source',
            'Operateur',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->forge->addForeignKey(
            'id_operateur_destination',
            'Operateur',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->forge->createTable('CommissionOperateur');
    }

    public function down()
    {
        $this->forge->dropTable('CommissionOperateur', true);
    }
}
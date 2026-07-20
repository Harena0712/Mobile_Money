<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateBaremeFrais extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INTEGER',
                'auto_increment' => true,
            ],
            'id_type_operation' => [
                'type' => 'INTEGER',
            ],
            'montant_min' => [
                'type'       => 'DECIMAL',
                'constraint' => '15,2',
            ],
            'montant_max' => [
                'type'       => 'DECIMAL',
                'constraint' => '15,2',
            ],
            'valeur' => [
                'type'       => 'DECIMAL',
                'constraint' => '15,2',
            ],
        ]);

        $this->forge->addPrimaryKey('id');

        $this->forge->addForeignKey(
            'id_type_operation',
            'TypeOperation',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->forge->createTable('BaremeFrais');
    }

    public function down()
    {
        $this->forge->dropTable('BaremeFrais');
    }
}
<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTransaction extends Migration
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
            'id_client_source' => [
                'type' => 'INTEGER',
                'null' => true,
            ],
            'id_client_destination' => [
                'type' => 'INTEGER',
                'null' => true,
            ],
            'montant' => [
                'type'       => 'DECIMAL',
                'constraint' => '15,2',
            ],
            'frais' => [
                'type'       => 'DECIMAL',
                'constraint' => '15,2',
            ],
            'date_transaction' => [
                'type'    => 'DATETIME',
                'default' => 'CURRENT_TIMESTAMP',
            ],
            'id_statut' => [
                'type' => 'INTEGER',
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

        $this->forge->addForeignKey(
            'id_client_source',
            'Client',
            'id',
            'CASCADE',
            'SET NULL'
        );

        $this->forge->addForeignKey(
            'id_client_destination',
            'Client',
            'id',
            'CASCADE',
            'SET NULL'
        );

        $this->forge->addForeignKey(
            'id_statut',
            'Statut',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->forge->createTable('Transaction');
    }

    public function down()
    {
        $this->forge->dropTable('Transaction');
    }
}
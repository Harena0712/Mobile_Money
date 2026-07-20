<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTransactionDestination extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INTEGER',
                'auto_increment' => true,
            ],
            'id_transaction' => [
                'type'       => 'INTEGER',
                'null'       => false,
            ],
            'id_client' => [
                'type'       => 'INTEGER',
                'null'       => false,
            ],
            'montant' => [
                'type'       => 'DECIMAL',
                'constraint' => '15,2',
                'null'       => false,
            ],
        ]);

        $this->forge->addKey('id', true);

        $this->forge->addForeignKey(
            'id_transaction',
            'Transaction',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->forge->addForeignKey(
            'id_client',
            'Client',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->forge->createTable('TransactionDestination');
    }

    public function down()
    {
        $this->forge->dropTable('TransactionDestination', true);
    }
}
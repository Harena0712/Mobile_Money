<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateMouvementCompte extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INTEGER',
                'auto_increment' => true,
            ],
            'transaction_id' => [
                'type' => 'INTEGER',
            ],
            'client_id' => [
                'type' => 'INTEGER',
            ],
            'montant' => [
                'type'       => 'DECIMAL',
                'constraint' => '15,2',
            ],
            'sens' => [
                'type'       => 'ENUM',
                'constraint' => ['DEBIT', 'CREDIT'],
            ],
        ]);

        $this->forge->addPrimaryKey('id');

        $this->forge->addForeignKey(
            'transaction_id',
            'Transaction',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->forge->addForeignKey(
            'client_id',
            'Client',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->forge->createTable('MouvementCompte');
    }

    public function down()
    {
        $this->forge->dropTable('MouvementCompte');
    }
}
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
            'id_transaction' => [
                'type' => 'INTEGER',
            ],
            'id_client' => [
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

        $this->forge->createTable('MouvementCompte');
    }

    public function down()
    {
        $this->forge->dropTable('MouvementCompte');
    }
}
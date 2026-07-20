<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddPrefixeForeignKeys extends Migration
{
    public function up()
    {
        $fields = [
            'id_prefixe' => [
                'type'    => 'INTEGER',
                'default' => 0,
                'null'    => false,
            ],
        ];

        $this->forge->addColumn('Client', $fields);

        $fields = [
            'id_operateur' => [
                'type'    => 'INTEGER',
                'default' => 0,
                'null'    => false,
            ],
        ];

        $this->forge->addColumn('Prefixe', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('Client', 'id_prefixe');
        $this->forge->dropColumn('Prefixe', 'id_operateur');
    }
}
 
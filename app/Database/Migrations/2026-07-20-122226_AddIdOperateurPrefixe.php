<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddIdOperateurPrefixe extends Migration
{
    public function up()
    {
        // Redundant migration: the id_operateur column is already added by
        // 2026-07-20-070345_AddPrefixeForeignKeys.php.
        // Keep this migration as a no-op to preserve version history.
    }

    public function down()
    {
        // No operation: leaving existing id_operateur column intact.
    }
}

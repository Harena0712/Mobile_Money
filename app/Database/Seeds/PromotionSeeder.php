<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PromotionSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'prommotion' => 10
            ],
        ];
        if (!empty($data)) {
            $this->db->table('Promotion')->insertBatch($data);
        }

    }
}

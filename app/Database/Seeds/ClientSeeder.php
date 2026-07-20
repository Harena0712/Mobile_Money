<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ClientSeeder extends Seeder
{
    public function run()
    {
        $table = $this->db->table('Client');
        $existing = array_column($table->select('telephone')->get()->getResultArray(), 'telephone');

        $data = [
            [
                'telephone' => '0331234567',
                'actif' => 1
            ],
            [
                'telephone' => '0349876543',
                'actif' => 1
            ],
            [
                'telephone' => '0374567890',
                'actif' => 1
            ],
            [
                'telephone' => '0381122334',
                'actif' => 1
            ]
        ];

        $insert = array_filter($data, function ($row) use ($existing) {
            return ! in_array($row['telephone'], $existing, true);
        });

        if (! empty($insert)) {
            $table->insertBatch($insert);
        }
    }
}
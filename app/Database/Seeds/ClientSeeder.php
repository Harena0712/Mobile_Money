<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ClientSeeder extends Seeder
{
    public function run()
    {
        $table = $this->db->table('Client');
        $existing = array_column($table->select('telephone')->get()->getResultArray(), 'telephone');

        $prefixes = $this->db->table('Prefixe')->select('id, prefixe')->get()->getResultArray();
        $prefixesParValeur = [];
        foreach ($prefixes as $prefixe) {
            $prefixesParValeur[(string) $prefixe['prefixe']] = (int) $prefixe['id'];
        }

        $data = [
            ['telephone' => '0331234567', 'actif' => 1],
            ['telephone' => '0349876543', 'actif' => 1],
            ['telephone' => '0374567890', 'actif' => 1],
            ['telephone' => '0381122334', 'actif' => 1],
        ];

        foreach ($data as &$client) {
            $client['id_prefixe'] = $prefixesParValeur[substr($client['telephone'], 0, 3)] ?? 0;
        }
        unset($client);

        $insert = array_filter($data, function ($row) use ($existing) {
            return ! in_array($row['telephone'], $existing, true);
        });

        if (! empty($insert)) {
            $table->insertBatch($insert);
        }

        foreach ($data as $client) {
            $table->where('telephone', $client['telephone'])->update([
                'id_prefixe' => $client['id_prefixe'],
            ]);
        }
    }
}

<?php

namespace App\Models;

use CodeIgniter\Model;

class ClientModel extends Model {
    protected $table = 'Client';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;
    protected $returnType = 'array';

    protected $allowedFields = [
        'telephone',
        'date_creation',
        'actif'
    ];

    public function chercherClientParTelephone(string $telephone): ?array
    {
        return $this->where('telephone', $telephone)->first();
    }

    public function chercherClientsParTelephone(array $telephones): array
    {
        $telephones = array_values(array_unique(array_filter(array_map(static function ($telephone) {
            return preg_replace('/[^0-9]/', '', (string) $telephone);
        }, $telephones))));

        if ($telephones === []) {
            return [];
        }

        return $this->whereIn('telephone', $telephones)->findAll();
    }

    public function telephoneExiste(string $telephone): bool
    {
        return $this->where('telephone', $telephone)->countAllResults(false) > 0;
    }

    public function clientActif(string $telephone): bool
    {
        return $this->where(['telephone' => $telephone, 'actif' => 1])->countAllResults(false) > 0;
    }

    public function telephonePrefixe(string $tel): bool
    {
        if ($tel === '') {
            return false;
        }

        $prefixeModel = new PrefixeModel();
        // $prefixes = $prefixeModel->where('actif', 1)->findAll();

        // foreach ($prefixes as $p) {
            // $pref = (string) ($p['prefixe'] ?? '');
            // if ($pref !== '' && strpos($tel, $pref) === 0) {
            //     return true;
            // }
            $operateur = $prefixeModel->chercherOperateurParTelephone($tel)['operateur'] ?? null;
            if ($operateur !== null && $operateur === 'Airtel') {
                return true;
            }
        // }

        return false;
    }
}

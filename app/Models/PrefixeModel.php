<?php

namespace App\Models;

use CodeIgniter\Model;

class PrefixeModel extends Model {
    protected $table = 'Prefixe';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;
    protected $returnType = 'array';

    protected $allowedFields = [
        'prefixe',
        'actif',
        'id_operateur'
    ];

    public function listePrefixe() {
        return $this->db->table($this->table . ' p')
            ->select('p.id, p.prefixe, p.actif, Operateur.libelle AS operateur')
            ->join('Operateur', 'Operateur.id = p.id_operateur', 'left')
            ->orderBy('p.id', 'ASC')
            ->get()
            ->getResultArray();
    }

    public function modifier($data) {
        $id = $data['id'];
        unset($data['id']);
        return $this->update($id, $data);
    }

    public function chercherOperateurParTelephone(string $telephone): ?array
    {
        $telephone = preg_replace('/[^0-9]/', '', $telephone);

        if ($telephone === '') {
            return null;
        }

        $prefixes = $this->db->table($this->table . ' p')
            ->select('p.prefixe, p.actif, Operateur.libelle AS operateur')
            ->join('Operateur', 'Operateur.id = p.id_operateur', 'left')
            ->where('p.actif', 1)
            ->orderBy('LENGTH(p.prefixe)', 'DESC', false)
            ->get()
            ->getResultArray();

        foreach ($prefixes as $prefixe) {
            $valeur = (string) ($prefixe['prefixe'] ?? '');

            if ($valeur !== '' && strpos($telephone, $valeur) === 0) {
                return [
                    'prefixe' => $valeur,
                    'operateur' => $prefixe['operateur'] ?: $this->operateurParDefaut($valeur),
                ];
            }
        }

        foreach ($this->operateursParDefaut() as $prefixe => $operateur) {
            if (strpos($telephone, $prefixe) === 0) {
                return [
                    'prefixe' => $prefixe,
                    'operateur' => $operateur,
                ];
            }
        }

        return null;
    }

    public function telephoneAirtel(string $telephone): bool
    {
        $operateur = $this->chercherOperateurParTelephone($telephone);

        return strtolower((string) ($operateur['operateur'] ?? '')) === 'airtel';
    }

    protected function operateurParDefaut(string $prefixe): ?string
    {
        $operateurs = $this->operateursParDefaut();

        return $operateurs[$prefixe] ?? null;
    }

    protected function operateursParDefaut(): array
    {
        return [
            '033' => 'Orange',
            '034' => 'Yas',
            '037' => 'Airtel',
        ];
    }
}

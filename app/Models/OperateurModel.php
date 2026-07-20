<?php

namespace App\Models;

use CodeIgniter\Model;

class OperateurModel extends Model {
    protected $table = 'Operateur';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;
    protected $returnType = 'array';

    protected $allowedFields = [
        'libelle',
        'actif'
    ];

    public function listerOperateurs(): array
    {
        return $this->findAll();
    }

    public function chercherOperateur(int $id): ?array
    {
        return $this->find($id);
    }

    public function chercherOperateurParLibelle(string $libelle): ?array
    {
        return $this->where('LOWER(libelle)', strtolower(trim($libelle)))->first();
    }

    /**
     * Mémorise l'opérateur utilisé par l'espace opérateur.
     */
    public function initialiserOperateurSession(string $libelle): ?array
    {
        $operateur = $this->chercherOperateurParLibelle($libelle);

        if ($operateur !== null) {
            $operateurSession = [
                'id' => (int) $operateur['id'],
                'libelle' => $operateur['libelle'],
            ];

            session()->set([
                'operateur_courant' => $operateurSession,
                'id_operateur' => $operateurSession['id'],
            ]);
        }

        return $operateur;
    }

    public function ajouterOperateur(string $nom): int
    {
        $data = [
            'libelle' => $nom,
            'actif'   => 1
        ];

        return (int) $this->insert($data, true);
    }

    public function modifierOperateur(int $id, string $nom): bool
    {
        return $this->update($id, ['libelle' => $nom]);
    }

    public function activerOperateur(int $id): bool
    {
        return $this->update($id, ['actif' => 1]);
    }

    public function desactiverOperateur(int $id): bool
    {
        return $this->update($id, ['actif' => 0]);
    }
}

<?php

namespace App\Models;

use CodeIgniter\Model;

class CommissionOperateurModel extends Model {
    protected $table = 'CommissionOperateur';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;
    protected $returnType = 'array';

    protected $allowedFields = [
        'id_operateur_source',
        'id_operateur_destination',
        'pourcentage'
    ];

    public function listerCommissions(): array
    {
        return $this->select('CommissionOperateur.*, source.libelle AS operateur_source, destination.libelle AS operateur_destination')
            ->join('Operateur AS source', 'source.id = CommissionOperateur.id_operateur_source')
            ->join('Operateur AS destination', 'destination.id = CommissionOperateur.id_operateur_destination')
            ->findAll();
    }

    public function chercherCommission(int $id): ?array
    {
        return $this->select('CommissionOperateur.*, id_operateur_source, id_operateur_destination, pourcentage')
            ->where('CommissionOperateur.id', $id)
            ->first();
    }

    public function ajouterCommission(array $data): int
    {
        return (int) $this->insert($data, true);
    }

    public function modifierCommission(int $id, array $data): bool
    {
        return $this->update($id, $data);
    }
}

<?php

namespace App\Models;

use CodeIgniter\Model;

class TransactionModel extends Model
{
    protected $table = 'Transaction';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;
    protected $returnType = 'array';

    protected $allowedFields = [
        'id_type_operation',
        'id_client_source',
        'id_client_destination',
        'montant',
        'frais',
        'date_transaction',
        'id_statut'
    ];

    public function creerTransactionDepot(int $idClient, float $montant, float $frais = 0.0): int
    {
        $typeOpModel = new TypeOperationModel();
        $typeOp = $typeOpModel->where('libelle', 'DEPOT')->first();
        if (! $typeOp) {
            throw new \Exception('Type opération DEPOT non trouvé.');
        }

        $statutModel = new StatutModel();
        $statut = $statutModel->where('libelle', 'SUCCES')->first();
        if (! $statut) {
            throw new \Exception('Statut SUCCES non trouvé.');
        }

        $data = [
            'id_type_operation' => $typeOp['id'],
            'id_client_source' => $idClient,
            'montant' => $montant,
            'frais' => $frais,
            'date_transaction' => date('Y-m-d H:i:s'),
            'id_statut' => $statut['id'],
        ];

        $this->insert($data);
        return $this->insertID();
    }
}
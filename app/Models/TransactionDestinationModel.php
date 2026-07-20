<?php

namespace App\Models;

use CodeIgniter\Model;

class TransactionDestinationModel extends Model
{
    protected $table = 'TransactionDestination';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;
    protected $returnType = 'array';

    protected $allowedFields = [
        'id_transaction',
        'id_client',
        'montant',
    ];

    public function ajouterDestination(int $idTransaction, int $idClient, float $montant): int
    {
        $this->insert([
            'id_transaction' => $idTransaction,
            'id_client'      => $idClient,
            'montant'        => $montant,
        ]);

        return $this->insertID();
    }
}

<?php

namespace App\Models;

use CodeIgniter\Model;

class MouvementCompteModel extends Model
{
    protected $table = 'MouvementCompte';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;
    protected $returnType = 'array';

    protected $allowedFields = [
        'id_transaction',
        'id_client',
        'montant',
        'sens'
    ];

    public function soldeClients() {
        // somme le solde de tout les client, si DEBIT alors le montant est négatif, si CREDIT alors le montant est positif
        $builder = $this->db->table('MouvementCompte');
        $builder->select('id_client, SUM(CASE WHEN sens = "CREDIT" THEN montant ELSE -montant END) as solde');
        $builder->groupBy('id_client');
        return $builder->get()->getResultArray();
    }

    public function calculerSolde(int $idClient): float
    {
        $mouvements = $this->where('id_client', $idClient)->findAll();

        $credit = 0.0;
        $debit = 0.0;

        foreach ($mouvements as $m) {
            $montant = (float) ($m['montant'] ?? 0);
            $sens = strtoupper(trim((string) ($m['sens'] ?? '')));
            if ($sens === 'CREDIT') {
                $credit += $montant;
            } elseif ($sens === 'DEBIT') {
                $debit += $montant;
            }
        }

        return $credit - $debit;
    }

    public function creerMouvementCredit(int $idTransaction, int $idClient, float $montant): int
    {
        $data = [
            'id_transaction' => $idTransaction,
            'id_client' => $idClient,
            'montant' => $montant,
            'sens' => 'CREDIT',
        ];

        $this->insert($data);
        return $this->insertID();
    }

    public function creerMouvementDebit(int $idTransaction, int $idClient, float $montant): int
    {
        $data = [
            'id_transaction' => $idTransaction,
            'id_client' => $idClient,
            'montant' => $montant,
            'sens' => 'DEBIT',
        ];

        $this->insert($data);
        return $this->insertID();
    }
}

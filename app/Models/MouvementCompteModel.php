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
        // somme le solde de tous les clients : CREDIT positif, DEBIT négatif
        $builder = $this->db->table('MouvementCompte mc');
        $builder->select('mc.id_client, c.telephone AS client_name, SUM(CASE WHEN mc.sens = "CREDIT" THEN mc.montant ELSE -mc.montant END) AS solde');
        $builder->join('Client c', 'c.id = mc.id_client', 'LEFT');
        $builder->groupBy('mc.id_client');
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

    public function creerMouvementsDestinataires(int $idTransaction, array $destinataires): array
    {
        $ids = [];

        foreach ($destinataires as $destinataire) {
            if (! isset($destinataire['id_client'])) {
                continue;
            }

            $ids[] = $this->creerMouvementCredit(
                $idTransaction,
                (int) $destinataire['id_client'],
                (float) ($destinataire['montant'] / count($destinataires))
            );
        }

        return $ids;
    }
}

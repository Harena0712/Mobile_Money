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
}
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

    public function getTotalFrais()
    {
        return $this->selectSum('frais')->first()['frais'];
    }

    public function getTotalTransfert()
    {
        return $this->where('id_type_operation', 2)->selectSum('frais')->first()['frais'];
    }

    public function getTotalRetrait()
    {
        return $this->where('id_type_operation', 3)->selectSum('frais')->first()['frais'];
    }

}
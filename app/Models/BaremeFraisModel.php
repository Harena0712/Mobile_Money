<?php

namespace App\Models;

use CodeIgniter\Model;

class BaremeFraisModel extends Model
{
    protected $table = 'BaremeFrais';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;
    protected $returnType = 'array';

    protected $allowedFields = [
        'id_type_operation',
        'montant_min',
        'montant_max',
        'valeur'
    ];

    public function getByIdTypeOperation($idTypeOperation)
    {
        return $this->where('id_type_operation', $idTypeOperation)->findAll();
    }

    public function modifier($data) {
        $id = $data['id'];
        unset($data['id']);
        return $this->update($id, $data);
    }
}
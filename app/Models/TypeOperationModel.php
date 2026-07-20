<?php

namespace App\Models;

use CodeIgniter\Model;

class TypeOperationModel extends Model
{
    protected $table = 'TypeOperation';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;
    protected $returnType = 'array';

    protected $allowedFields = [
        'libelle',
        'actif'
    ];

    public function modifier($data) {
        $id = $data['id'];
        unset($data['id']);
        return $this->update($id, $data);
    }
}
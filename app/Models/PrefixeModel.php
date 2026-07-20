<?php

namespace App\Models;

use CodeIgniter\Model;

class PrefixeModel extends Model {
    protected $table = 'Prefixe';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;
    protected $returnType = 'array';

    protected $allowedFields = [
        'prefixe',
        'actif'
    ];

    public function modifier($data) {
        $id = $data['id'];
        unset($data['id']);
        return $this->update($id, $data);
    }
}
<?php

namespace App\Models;

use CodeIgniter\Model;

class StatutModel extends Model
{
    protected $table = 'Statut';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;
    protected $returnType = 'array';

    protected $allowedFields = [
        'libelle'
    ];
}
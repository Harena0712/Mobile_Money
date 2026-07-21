<?php

namespace App\Models;

use CodeIgniter\Model;

class EpargneModel extends Model {
    protected $table = 'Epargne';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;
    protected $returnType = 'array';

    protected $allowedFields = [
        'idClient',
        'pourcentageEpargne'
    ];

}

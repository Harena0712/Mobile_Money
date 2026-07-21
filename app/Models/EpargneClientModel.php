<?php

namespace App\Models;

use CodeIgniter\Model;

class EpargneClientModel extends Model {
    protected $table = 'EpargneClient';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;
    protected $returnType = 'array';

    protected $allowedFields = [
        'idClient',
        'montantEpargne'
    ];

}

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

    public function chercherFraisRetrait(float $montant): ?float
    {
        $typeOperationModel = new TypeOperationModel();
        $typeOperation = $typeOperationModel->where('libelle', 'RETRAIT')->first();

        if (! $typeOperation) {
            throw new \Exception('Type opération RETRAIT non trouvé.');
        }

        $bareme = $this->where('id_type_operation', $typeOperation['id'])
            ->where('montant_min <=', $montant)
            ->where('montant_max >=', $montant)
            ->first();

        if (! $bareme) {
            return null;
        }

        return (float) $bareme['valeur'];
    }
}

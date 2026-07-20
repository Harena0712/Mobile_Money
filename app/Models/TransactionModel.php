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
    public function creerTransactionDepot(int $idClient, float $montant, float $frais = 0.0): int
    {
        $typeOpModel = new TypeOperationModel();
        $typeOp = $typeOpModel->where('libelle', 'DEPOT')->first();
        if (! $typeOp) {
            throw new \Exception('Type opération DEPOT non trouvé.');
        }

        $statutModel = new StatutModel();
        $statut = $statutModel->where('libelle', 'SUCCES')->first();
        if (! $statut) {
            throw new \Exception('Statut SUCCES non trouvé.');
        }

        $data = [
            'id_type_operation' => $typeOp['id'],
            'id_client_source' => $idClient,
            'montant' => $montant,
            'frais' => $frais,
            'date_transaction' => date('Y-m-d H:i:s'),
            'id_statut' => $statut['id'],
        ];

        $this->insert($data);
        return $this->insertID();
    }

    public function creerTransactionRetrait(int $idClient, float $montant, float $frais): int
    {
        $typeOpModel = new TypeOperationModel();
        $typeOp = $typeOpModel->where('libelle', 'RETRAIT')->first();
        if (! $typeOp) {
            throw new \Exception('Type opération RETRAIT non trouvé.');
        }

        $statutModel = new StatutModel();
        $statut = $statutModel->where('libelle', 'VALIDEE')->first()
            ?? $statutModel->where('libelle', 'SUCCES')->first();
        if (! $statut) {
            throw new \Exception('Statut VALIDEE ou SUCCES non trouvé.');
        }

        $data = [
            'id_type_operation' => $typeOp['id'],
            'id_client_source' => $idClient,
            'id_client_destination' => null,
            'montant' => $montant,
            'frais' => $frais,
            'date_transaction' => date('Y-m-d H:i:s'),
            'id_statut' => $statut['id'],
        ];

        $this->insert($data);
        return $this->insertID();
    }

    public function creerTransactionTransfert(int $idClientSource, int $idClientDestination, float $montant, float $frais): int
    {
        $typeOpModel = new TypeOperationModel();
        $typeOp = $typeOpModel->where('libelle', 'TRANSFERT')->first();
        if (! $typeOp) {
            throw new \Exception('Type opération TRANSFERT non trouvé.');
        }

        $statutModel = new StatutModel();
        $statut = $statutModel->where('libelle', 'VALIDEE')->first()
            ?? $statutModel->where('libelle', 'SUCCES')->first();
        if (! $statut) {
            throw new \Exception('Statut VALIDEE ou SUCCES non trouvé.');
        }

        $data = [
            'id_type_operation' => $typeOp['id'],
            'id_client_source' => $idClientSource,
            'id_client_destination' => $idClientDestination,
            'montant' => $montant,
            'frais' => $frais,
            'date_transaction' => date('Y-m-d H:i:s'),
            'id_statut' => $statut['id'],
        ];

        $this->insert($data);
        return $this->insertID();
    }

    public function listerHistorique(int $idClient): array
    {
        return $this->db->table($this->table . ' t')
            ->select('t.*, TypeOperation.libelle AS type_operation, Statut.libelle AS statut')
            ->join('TypeOperation', 'TypeOperation.id = t.id_type_operation')
            ->join('Statut', 'Statut.id = t.id_statut')
            ->groupStart()
                ->where('t.id_client_source', $idClient)
                ->orWhere('t.id_client_destination', $idClient)
            ->groupEnd()
            ->orderBy('t.date_transaction', 'DESC')
            ->get()
            ->getResultArray();
    }
}

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
        'id_statut',
        'inclure_frais_retrait'
    ];

    public function getTotalFrais()
    {
        $row = $this->selectSum('frais')->get()->getRowArray();

        return (float) ($row['frais'] ?? 0);
    }

    public function getTotalTransfert()
    {
        $row = $this->where('id_type_operation', 2)->selectSum('frais')->get()->getRowArray();

        return (float) ($row['frais'] ?? 0);
    }

    public function getTotalRetrait()
    {
        $row = $this->where('id_type_operation', 3)->selectSum('frais')->get()->getRowArray();

        return (float) ($row['frais'] ?? 0);
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

    public function creerTransactionMultiple(int $idClientSource, float $montantTotal, float $frais): int
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
            'id_client_destination' => null,
            'montant' => $montantTotal,
            'frais' => $frais,
            'date_transaction' => date('Y-m-d H:i:s'),
            'id_statut' => $statut['id'],
        ];

        $this->insert($data);
        return $this->insertID();
    }

    public function mettreAJourFraisRetrait(int $idTransaction, bool $inclureFraisRetrait): bool
    {
        return $this->update($idTransaction, [
            'inclure_frais_retrait' => $inclureFraisRetrait ? 1 : 0,
        ]);
    }
    
    public function calculerGains(): array
    {
        $db = $this->db;
        $query = $db->table($this->table . ' t')
            ->select('SUM(CASE WHEN t.id_type_operation IN (1, 2, 3) THEN t.frais ELSE 0 END) AS total_frais')
            ->select('SUM(CASE WHEN t.id_type_operation = 2 THEN t.frais ELSE 0 END) AS total_frais_transfert')
            ->select('SUM(CASE WHEN t.id_type_operation = 3 THEN t.frais ELSE 0 END) AS total_frais_retrait')
            ->select('COUNT(CASE WHEN t.id_type_operation = 1 THEN 1 END) AS total_depots')
            ->select('COUNT(CASE WHEN t.id_type_operation = 2 THEN 1 END) AS total_transferts')
            ->select('COUNT(CASE WHEN t.id_type_operation = 3 THEN 1 END) AS total_retraits')
            ->get();

        $result = $query->getRowArray();
        $commissions = $this->calculerCommissionsInterOperateurs();

        return [
            'total_frais' => (float) ($result['total_frais'] ?? 0),
            'total_frais_transfert' => (float) ($result['total_frais_transfert'] ?? 0),
            'total_frais_retrait' => (float) ($result['total_frais_retrait'] ?? 0),
            'total_depots' => (int) ($result['total_depots'] ?? 0),
            'total_transferts' => (int) ($result['total_transferts'] ?? 0),
            'total_retraits' => (int) ($result['total_retraits'] ?? 0),
            'total_commissions_interoperateurs' => $commissions,
        ];
    }

    private function calculerCommissionsInterOperateurs(): float
    {
        $db = $this->db;

        if (! method_exists($db, 'tableExists') || ! $db->tableExists('TransactionDestination')) {
            return 0.0;
        }

        try {
            $query = $db->table($this->table . ' t')
                ->select('t.montant, os.id AS source_operateur_id, od.id AS destination_operateur_id')
                ->join('TransactionDestination td', 'td.id_transaction = t.id')
                ->join('Client cs', 'cs.id = t.id_client_source')
                ->join('Prefixe ps', 'ps.id = cs.id_prefixe', 'LEFT')
                ->join('Operateur os', 'os.id = ps.id_operateur', 'LEFT')
                ->join('Client cd', 'cd.id = td.id_client')
                ->join('Prefixe pd', 'pd.id = cd.id_prefixe', 'LEFT')
                ->join('Operateur od', 'od.id = pd.id_operateur', 'LEFT')
                ->where('t.id_type_operation', 2)
                ->get();

            $commissionModel = new \App\Models\CommissionOperateurModel();
            $total = 0.0;

            foreach ($query->getResultArray() as $row) {
                if (empty($row['source_operateur_id']) || empty($row['destination_operateur_id'])) {
                    continue;
                }

                $pourcentage = $commissionModel->getPourcentage((int) $row['source_operateur_id'], (int) $row['destination_operateur_id']);
                if ($pourcentage === null) {
                    continue;
                }

                $total += ((float) $row['montant']) * ($pourcentage / 100);
            }

            return $total;
        } catch (\Exception $e) {
            return 0.0;
        }
    }

    public function calculerMontantsParOperateur(): array
    {
        $db = $this->db;

        if (! method_exists($db, 'tableExists') || ! $db->tableExists('TransactionDestination')) {
            return [];
        }

        try {
            $query = $db->table($this->table . ' t')
                ->select('o.id AS id_operateur, o.libelle AS operateur, SUM(td.montant) AS total_montant')
                ->join('TransactionDestination td', 'td.id_transaction = t.id')
                ->join('Client c', 'c.id = td.id_client')
                ->join('Prefixe p', 'p.id = c.id_prefixe', 'LEFT')
                ->join('Operateur o', 'o.id = p.id_operateur', 'LEFT')
                ->where('t.id_type_operation', 2)
                ->groupBy('o.id, o.libelle')
                ->get();

            return array_map(function ($row) {
                return [
                    'id_operateur' => $row['id_operateur'],
                    'operateur' => $row['operateur'],
                    'total_montant' => (float) $row['total_montant'],
                ];
            }, $query->getResultArray());
        } catch (\Exception $e) {
            return [];
        }
    }

    public function calculerGainsParOperateur(): array
    {
        $db = $this->db;

        $query = $db->table($this->table . ' t')
            ->select('o.id AS id_operateur, o.libelle AS operateur')
            ->select('SUM(t.frais) AS total_frais')
            ->select('SUM(CASE WHEN t.id_type_operation = 2 THEN t.frais ELSE 0 END) AS total_frais_transfert')
            ->select('SUM(CASE WHEN t.id_type_operation = 3 THEN t.frais ELSE 0 END) AS total_frais_retrait')
            ->select('SUM(CASE WHEN t.id_type_operation = 1 THEN 1 ELSE 0 END) AS total_depots')
            ->select('SUM(CASE WHEN t.id_type_operation = 2 THEN 1 ELSE 0 END) AS total_transferts')
            ->select('SUM(CASE WHEN t.id_type_operation = 3 THEN 1 ELSE 0 END) AS total_retraits')
            ->join('Client c', 'c.id = t.id_client_source', 'LEFT')
            ->join('Prefixe p', 'p.id = c.id_prefixe', 'LEFT')
            ->join('Operateur o', 'o.id = p.id_operateur', 'LEFT')
            ->where('o.id IS NOT NULL')
            ->groupBy('o.id, o.libelle')
            ->get();

        return array_map(function ($row) {
            return [
                'id_operateur' => $row['id_operateur'],
                'operateur' => $row['operateur'],
                'total_frais' => (float) ($row['total_frais'] ?? 0),
                'total_frais_transfert' => (float) ($row['total_frais_transfert'] ?? 0),
                'total_frais_retrait' => (float) ($row['total_frais_retrait'] ?? 0),
                'total_depots' => (int) ($row['total_depots'] ?? 0),
                'total_transferts' => (int) ($row['total_transferts'] ?? 0),
                'total_retraits' => (int) ($row['total_retraits'] ?? 0),
            ];
        }, $query->getResultArray());
    }

    public function listerHistorique(int $idClient): array
    {
        return $this->db->table($this->table . ' t')
            ->select('t.*, TypeOperation.libelle AS type_operation, Statut.libelle AS statut')
            ->distinct()
            ->join('TypeOperation', 'TypeOperation.id = t.id_type_operation')
            ->join('Statut', 'Statut.id = t.id_statut')
            ->join('TransactionDestination td', 'td.id_transaction = t.id', 'left')
            ->groupStart()
            ->where('t.id_client_source', $idClient)
            ->orWhere('t.id_client_destination', $idClient)
            ->orWhere('td.id_client', $idClient)
            ->groupEnd()
            ->orderBy('t.date_transaction', 'DESC')
            ->get()
            ->getResultArray();
    }
}

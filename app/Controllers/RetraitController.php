<?php

namespace App\Controllers;

use App\Models\BaremeFraisModel;
use App\Models\MouvementCompteModel;
use App\Models\TransactionModel;
use Config\Database;

class RetraitController extends BaseController
{
    public function index()
    {
        if (! $this->clientConnecte()) {
            return redirect()->to('/login');
        }

        $data = [
            'success' => session()->getFlashdata('success'),
            'error' => session()->getFlashdata('error'),
        ];

        return view('client/retrait', $data);
    }

    public function enregistrer()
    {
        if (! $this->clientConnecte()) {
            return redirect()->to('/login');
        }

        $montant = (float) ($this->request->getPost('montant') ?? 0);

        if (! $this->montantValide($montant)) {
            return redirect()->to('/retrait')->with('error', 'Montant invalide. Le montant doit être supérieur à 0.');
        }

        $idClient = (int) session()->get('id_client');

        try {
            $baremeFraisModel = new BaremeFraisModel();
            $frais = $baremeFraisModel->chercherFraisRetrait($montant);

            if ($frais === null) {
                return redirect()->to('/retrait')->with('error', 'Aucun barème de frais trouvé pour ce montant.');
            }

            $montantTotal = $montant + $frais;

            if (! $this->soldeSuffisant($idClient, $montantTotal)) {
                return redirect()->to('/retrait')->with('error', 'Solde insuffisant pour effectuer ce retrait.');
            }

            $db = Database::connect();
            $db->transStart();

            $transactionModel = new TransactionModel();
            $idTransaction = $transactionModel->creerTransactionRetrait($idClient, $montant, $frais);

            $mouvementModel = new MouvementCompteModel();
            $mouvementModel->creerMouvementDebit($idTransaction, $idClient, $montantTotal);

            $db->transComplete();

            if (! $db->transStatus()) {
                return redirect()->to('/retrait')->with('error', 'Une erreur est survenue lors du retrait.');
            }

            $message = 'Retrait effectué avec succès. Frais : ' . number_format($frais, 2, '.', ' ') . ' AR.';

            return redirect()->to('/retrait')->with('success', $message);
        } catch (\Exception $e) {
            return redirect()->to('/retrait')->with('error', 'Une erreur est survenue lors du retrait.');
        }
    }

    protected function clientConnecte(): bool
    {
        return (bool) session()->get('connecte');
    }

    protected function montantValide(float $montant): bool
    {
        return $montant > 0;
    }

    protected function soldeSuffisant(int $idClient, float $montantTotal): bool
    {
        $mouvementModel = new MouvementCompteModel();
        $solde = $mouvementModel->calculerSolde($idClient);

        return $solde >= $montantTotal;
    }
}

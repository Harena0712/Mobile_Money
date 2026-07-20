<?php

namespace App\Controllers;

use App\Models\TransactionModel;
use App\Models\MouvementCompteModel;

class DepotController extends BaseController
{
    public function index()
    {
        if (! session()->get('connecte')) {
            return redirect()->to('/client/login');
        }

        $data = [
            'success' => session()->getFlashdata('success'),
            'error' => session()->getFlashdata('error'),
        ];

        return view('client/depot', $data);
    }

    public function enregistrer()
    {
        if (! session()->get('connecte')) {
            return redirect()->to('/client/login');
        }

        $montant = (float) ($this->request->getPost('montant') ?? 0);

        if (! $this->montantValide($montant)) {
            return redirect()->to('/client/depot')->with('error', 'Montant invalide. Le montant doit être supérieur à 0.');
        }

        $idClient = (int) session()->get('id_client');

        try {
            $transactionModel = new TransactionModel();
            $idTransaction = $transactionModel->creerTransactionDepot($idClient, $montant);

            $mouvementModel = new MouvementCompteModel();
            $mouvementModel->creerMouvementCredit($idTransaction, $idClient, $montant);

            return redirect()->to('/client/depot')->with('success', 'Dépôt effectué avec succès !');
        } catch (\Exception $e) {
            return redirect()->to('/client/depot')->with('error', 'Une erreur est survenue lors du dépôt.');
        }
    }

    protected function montantValide(float $montant): bool
    {
        return $montant > 0;
    }
}

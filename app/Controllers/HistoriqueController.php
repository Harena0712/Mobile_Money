<?php

namespace App\Controllers;

use App\Models\TransactionModel;

class HistoriqueController extends BaseController
{
    public function index()
    {
        if (! $this->clientConnecte()) {
            return redirect()->to('/login');
        }

        $idClient = (int) session()->get('id_client');

        $transactionModel = new TransactionModel();
        $transactions = $transactionModel->listerHistorique($idClient);

        $data = [
            'transactions' => $transactions,
        ];

        return view('client/historique', $data);
    }

    protected function clientConnecte(): bool
    {
        return (bool) session()->get('connecte');
    }
}

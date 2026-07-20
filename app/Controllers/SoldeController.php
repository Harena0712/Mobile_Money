<?php

namespace App\Controllers;

use App\Models\MouvementCompteModel;

class SoldeController extends BaseController
{
    public function index()
    {
        if (! session()->get('connecte')) {
            return redirect()->to('/login');
        }

        $idClient = (int) session()->get('id_client');
        // if ($idClient <= 0) {
        //     return redirect()->to('/client/login');
        // }

        $mouvementModel = new MouvementCompteModel();
        $solde = $mouvementModel->calculerSolde($idClient);

        $data = [
            'telephone' => session()->get('telephone'),
            'solde' => $solde,
        ];

        return view('client/solde', $data);
    }
}

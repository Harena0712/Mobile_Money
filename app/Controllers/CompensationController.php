<?php

namespace App\Controllers;

use App\Models\TransactionModel;

class CompensationController extends BaseController
{
    public function index()
    {
        return view('compensation/index', (new TransactionModel())->listerCompensationsOperateurCourant());
    }

    public function detail($operateur)
    {
        $transactionModel = new TransactionModel();
        $data['transactions'] = $transactionModel->listerCompensationsParOperateur($operateur);
        $data['operateur'] = $operateur;

        return view('compensation/detail', $data);
    }
}

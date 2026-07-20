<?php

namespace App\Controllers;

use App\Models\TransactionModel;

class CompensationController extends BaseController
{
    public function index()
    {
        $model = new TransactionModel();
        $data['compensations'] = $model->calculerMontantsParOperateur();

        return view('compensation/index', $data);
    }
}

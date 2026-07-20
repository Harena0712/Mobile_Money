<?php

namespace App\Controllers;

use App\Models\TransactionModel;

class GainController extends BaseController
{
    public function index()
    {
        $model = new TransactionModel();
        $data = $model->calculerGains();
        $data['gains_par_operateur'] = $model->calculerGainsParOperateur();

        return view('gain/index', $data);
    }
}

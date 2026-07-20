<?php

namespace App\Controllers;

use App\Models\TransactionModel;

class GainController extends BaseController
{
    public function index()
    {
        $model = new TransactionModel();
        $data = $model->calculerGains();

        return view('gain/index', $data);
    }
}

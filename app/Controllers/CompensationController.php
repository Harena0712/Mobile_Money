<?php

namespace App\Controllers;

use App\Models\TransactionModel;

class CompensationController extends BaseController
{
    public function index()
    {
        return view('compensation/index', (new TransactionModel())->listerCompensationsOperateurCourant());
    }
}

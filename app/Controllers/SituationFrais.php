<?php

namespace App\Controllers;

use App\Models\TransactionModel;

class SituationFrais extends BaseController
{
    public function liste()
    {
        $model = new TransactionModel();
        $data['transactions'] = $model->findAll();
        $data['totalFrais'] = $model->getTotalFrais();
        $data['totalTransfert'] = $model->getTotalTransfert();
        $data['totalRetrait'] = $model->getTotalRetrait();

        return view('operateur/situationFrais/liste', $data);
    }
}
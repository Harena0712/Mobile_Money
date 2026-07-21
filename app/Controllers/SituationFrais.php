<?php

namespace App\Controllers;

use App\Models\TransactionModel;
use App\Models\TypeOperationModel;

class SituationFrais extends BaseController
{
    public function liste()
    {
        $transactionModel = new TransactionModel();
        $typeOperationModel = new TypeOperationModel();

        $data['transactions'] = $transactionModel->findAll();
        $data['typeOperations'] = $typeOperationModel->getTypeOperationList();
        $data['totalFrais'] = $transactionModel->getTotalFrais();
        $data['totalTransfert'] = $transactionModel->getTotalTransfert();
        $data['totalRetrait'] = $transactionModel->getTotalRetrait();

        return view('operateur/situationFrais/liste', $data);
    }
}
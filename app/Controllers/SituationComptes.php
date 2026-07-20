<?php

namespace App\Controllers;
use App\Models\MouvementCompteModel;

class SituationComptes extends BaseController
{
    public function liste() {
        $model = new MouvementCompteModel();
        $data['soldeClients'] = $model->soldeClients();
        
        return view('operateur/situationComptes/liste', $data);
    }
}
<?php

namespace App\Controllers;

use App\Models\OperateurModel;

class AccueilController extends BaseController
{
    public function index()
    {
        (new OperateurModel())->initialiserOperateurSession('Airtel');

        return view('accueil', [
            'title' => 'Choisir un espace',
        ]);
    }
}

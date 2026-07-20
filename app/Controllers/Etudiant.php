<?php

namespace App\Controllers;
use App\Models\EtudiantModel;

class Etudiant extends BaseController
{
    public function index() {
        $model = new EtudiantModel();
        $data['etudiants'] = $model->findAll();
        return view('etudiants', $data);
    }
}
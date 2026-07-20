<?php

namespace App\Controllers;

use App\Models\OperateurModel;

class OperateurController extends BaseController
{
    public function index()
    {
        $model = new OperateurModel();
        $data['operateurs'] = $model->listerOperateurs();

        return view('operateur/index', $data);
    }

    public function ajouter()
    {
        return view('operateur/ajouter');
    }

    public function enregistrer()
    {
        $model = new OperateurModel();
        $nom = $this->request->getPost('nom');

        if (empty($nom)) {
            return redirect()->back()->with('error', 'Le nom de l\'opérateur est requis.');
        }

        $model->ajouterOperateur($nom);
        return redirect()->to(site_url('operateur'))->with('success', 'Opérateur ajouté avec succès.');
    }

    public function modifier()
    {
        $model = new OperateurModel();
        $id = (int) $this->request->getPost('id');
        $nom = $this->request->getPost('nom');

        if ($id <= 0 || empty($nom)) {
            return redirect()->back()->with('error', 'Identifiant ou nom invalide.');
        }

        $model->modifierOperateur($id, $nom);
        return redirect()->to(site_url('operateur'))->with('success', 'Opérateur modifié avec succès.');
    }

    public function activer()
    {
        $model = new OperateurModel();
        $id = (int) $this->request->getPost('id');

        if ($id <= 0) {
            return redirect()->back()->with('error', 'Identifiant invalide.');
        }

        $model->activerOperateur($id);
        return redirect()->to(site_url('operateur'))->with('success', 'Opérateur activé.');
    }

    public function desactiver()
    {
        $model = new OperateurModel();
        $id = (int) $this->request->getPost('id');

        if ($id <= 0) {
            return redirect()->back()->with('error', 'Identifiant invalide.');
        }

        $model->desactiverOperateur($id);
        return redirect()->to(site_url('operateur'))->with('success', 'Opérateur désactivé.');
    }
}

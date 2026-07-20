<?php

namespace App\Controllers;

use App\Models\CommissionOperateurModel;
use App\Models\OperateurModel;

class CommissionOperateurController extends BaseController
{
    public function index()
    {
        $model = new CommissionOperateurModel();
        $data['commissions'] = $model->listerCommissions();

        return view('commission/index', $data);
    }

    public function ajouter()
    {
        $operateurModel = new OperateurModel();
        $data['operateurs'] = $operateurModel->listerOperateurs();

        return view('commission/form', $data);
    }

    public function enregistrer()
    {
        $commissionModel = new CommissionOperateurModel();

        $data = [
            'id_operateur_source' => (int) $this->request->getPost('id_operateur_source'),
            'id_operateur_destination' => (int) $this->request->getPost('id_operateur_destination'),
            'pourcentage' => $this->request->getPost('pourcentage'),
        ];

        $commissionModel->ajouterCommission($data);
        return redirect()->to(site_url('commission'))->with('success', 'Commission ajoutée.');
    }

    public function modifier()
    {
        $commissionModel = new CommissionOperateurModel();
        $id = (int) $this->request->getPost('id');

        $data = [
            'id_operateur_source' => (int) $this->request->getPost('id_operateur_source'),
            'id_operateur_destination' => (int) $this->request->getPost('id_operateur_destination'),
            'pourcentage' => $this->request->getPost('pourcentage'),
        ];

        $commissionModel->modifierCommission($id, $data);
        return redirect()->to(site_url('commission'))->with('success', 'Commission modifiée.');
    }

    public function formulaireModification(int $id)
    {
        $commissionModel = new CommissionOperateurModel();
        $commission = $commissionModel->chercherCommission($id);

        if ($commission === null) {
            return redirect()->to(site_url('commission'))->with('error', 'Commission introuvable.');
        }

        return view('commission/form', [
            'commission' => $commission,
            'operateurs' => (new OperateurModel())->listerOperateurs(),
        ]);
    }

    public function supprimer(int $id)
    {
        $commissionModel = new CommissionOperateurModel();

        if (! $commissionModel->supprimerCommission($id)) {
            return redirect()->to(site_url('commission'))->with('error', 'Impossible de supprimer cette commission.');
        }

        return redirect()->to(site_url('commission'))->with('success', 'Commission supprimée.');
    }
}

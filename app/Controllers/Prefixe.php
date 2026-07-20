<?php

namespace App\Controllers;
use App\Models\PrefixeModel;
use App\Models\OperateurModel;

class Prefixe extends BaseController
{
    public function liste() {
        $model = new PrefixeModel();
        $data['prefixes'] = $model->listePrefixe();

        return view('operateur/prefixes/liste', $data);
    }

    public function create() {
        return view('operateur/prefixes/create', [
            'operateurs' => (new OperateurModel())->listerOperateurs(),
        ]);
    }

    public function inserer() {
        $model = new PrefixeModel();
        $data = [
            'prefixe' => $this->request->getPost('prefixe'),
            'id_operateur' => (int) $this->request->getPost('id_operateur'),
        ];
        $model->insert($data);
        return redirect()->to(site_url('/'));
    }

    public function delete($id) {
        $model = new PrefixeModel();
        $model->delete($id);
        return redirect()->to(site_url('/'));
    }

    public function modif($id) {
        $model = new PrefixeModel();
        $operateurModel = new OperateurModel();
        $data['prefixe'] = $model->find($id);
        $data['operateurs'] = $operateurModel->listerOperateurs();
        return view('operateur/prefixes/modif', $data);
    }

    public function update() {
        $model = new PrefixeModel();
        $data = [
            'id' => $this->request->getPost('id'),
            'prefixe' => $this->request->getPost('prefixe'),
            'id_operateur' => (int) $this->request->getPost('id_operateur'),
        ];
        $model->modifier($data);
        return redirect()->to(site_url('/'));
    }
}

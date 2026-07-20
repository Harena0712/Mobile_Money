<?php

namespace App\Controllers;
use App\Models\PrefixeModel;

class Prefixe extends BaseController
{
    public function liste() {
        $model = new PrefixeModel();
        $data['prefixes'] = $model->findAll();
        return view('operateur/prefixes/liste', $data);
    }

    public function create() {
        return view('operateur/prefixes/create');
    }

    public function inserer() {
        $model = new PrefixeModel();
        $data = [
            'prefixe' => $this->request->getPost('prefixe'),
        ];
        $model->insert($data);
        return redirect()->to(site_url('operateur/prefixes'));
    }

    public function delete($id) {
        $model = new PrefixeModel();
        $model->delete($id);
        return redirect()->to(site_url('operateur/prefixes'));
    }

    public function modif($id) {
        $model = new PrefixeModel();
        $data['prefixe'] = $model->find($id);
        return view('operateur/prefixes/modif', $data);
    }

    public function update() {
        $model = new PrefixeModel();
        $data = [
            'id' => $this->request->getPost('id'),
            'prefixe' => $this->request->getPost('prefixe'),
        ];
        $model->modifier($data);
        return redirect()->to(site_url('operateur/prefixes'));
    }
}
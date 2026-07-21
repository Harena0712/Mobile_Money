<?php

namespace App\Controllers;
use App\Models\EpargneClientModel;


class EpargneClientController extends BaseController
{
    // public function index()
    // {
    //     if (! $this->clientConnecte()) {
    //         return redirect()->to('/login');
    //     }

    //     $data = [
    //         'success' => session()->getFlashdata('success'),
    //         'error' => session()->getFlashdata('error'),
    //     ];

    //     return view('client/epargne', $data);
    // }

    public function liste() {
        // $model = new EpargneClientModel();
        // $data['prefixes'] = $model->listePrefixe();

        // return view('operateur/prefixes/liste', $data);
    }

    public function create() {
        // return view('operateur/prefixes/create', [
        //     '' => (new OperateurModel())->listerOperateurs(),
        // ]);
    }

    public function inserer() {
        $model = new EpargneClientModel();
        $idClient = (int) session()->get('id_client');
        $data = [
            'idClient' => $idClient,
            'pourcentageEpargne' => (int) $this->request->getPost('pourcentageEpargne'),
        ];
        $model->insert($data);
        return redirect()->to(site_url('/client/epargne'));
    }

    public function delete($id) {
        $model = new EpargneClientModel();
        $model->delete($id);
        return redirect()->to(site_url('/'));
    }

    public function modif($id) {
        // $model = new EpargneClientModel();
        // $operateurModel = new OperateurModel();
        // $data['prefixe'] = $model->find($id);
        // $data['operateurs'] = $operateurModel->listerOperateurs();
        // return view('operateur/prefixes/modif', $data);
    }

    public function update() {
        $model = new EpargneClientModel();
        $data = [
            'id' => $this->request->getPost('id'),
            'idClient' => $this->request->getPost('idClient'),
            'pourcentageEpargne' => (int) $this->request->getPost('pourcentageEpargne'),
        ];
        $model->modifier($data);
        return redirect()->to(site_url('/'));
    }

    protected function clientConnecte(): bool
    {
        return (bool) session()->get('connecte');
    }


}

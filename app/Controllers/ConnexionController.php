<?php

namespace App\Controllers;

use App\Models\ClientModel;

class ConnexionController extends BaseController
{
    public function index()
    {
        helper('form');

        $data = [
            'error' => session()->getFlashdata('error'),
        ];

        return view('client/login', $data);
    }

    public function login()
    {
        $telephone = trim($this->request->getPost('telephone'));

        if (empty($telephone)) {
            return redirect()->to('/client/login')->with('error', 'Veuillez saisir votre téléphone.');
        }

        $clientModel = new ClientModel();
        
        $telephone = preg_replace('/[^0-9]/', '', $telephone);
        if (! $clientModel->telephonePrefixe($telephone)) {
            return redirect()->to('/client/login')->with('error', 'Préfixe téléphonique invalide.');
        }


        $client = $clientModel->chercherClientParTelephone($telephone);

        if (empty($client)) {
            return redirect()->to('/client/login')->with('error', 'Téléphone non trouvé.');
        }

        if ((int) ($client['actif'] ?? 0) !== 1) {
            return redirect()->to('/client/login')->with('error', 'Client inactif.');
        }

        session()->set([
            'id_client' => $client['id'],
            'telephone' => $client['telephone'],
            'connecte' => true,
        ]);

        return redirect()->to('/');
    }

    public function logout()
    {
        session()->destroy();

        return redirect()->to('/client/login');
    }
}

<?php

namespace App\Controllers;

use App\Models\TypeOperationModel;
use App\Models\BaremeFraisModel;

class TypeOperation extends BaseController
{
    public function liste()
    {
        $model = new TypeOperationModel();
        $data['typeOperations'] = $model->findAll();
        return view('operateur/typeOperations/liste', $data);
    }

    public function voir($id)
    {
        $model = new TypeOperationModel();
        $BaremeFraismodel = new BaremeFraisModel();
        $data['typeOperation'] = $model->find($id);
        $data['baremeFrais'] = $BaremeFraismodel->getByIdTypeOperation($id);
        return view('operateur/typeOperations/voir', $data);
    }

    public function create()
    {
        return view('operateur/typeOperations/create');
    }

    public function inserer()
    {
        $typeOperationModel = new TypeOperationModel();
        $baremeFraisModel   = new BaremeFraisModel();

        $dataTypeOperation = [
            'libelle' => $this->request->getPost('libelle'),
        ];

        $typeOperationModel->insert($dataTypeOperation);

        $idTypeOperation = $typeOperationModel->getInsertID();

        $baremes = $this->request->getPost('baremes');


        foreach ($baremes as $bareme) {

            $baremeFraisModel->insert([
                'id_type_operation' => $idTypeOperation,
                'montant_min'       => $bareme['montant_min'],
                'montant_max'       => $bareme['montant_max'],
                'valeur'            => $bareme['valeur'],
            ]);
        }


        return redirect()->to(site_url('operateur/typesOperation'));
    }

    public function delete($id) {
        $model = new TypeOperation();
        $model->delete($id);
        return redirect()->to(site_url('operateur/typeOperations'));
    }

    public function modif($id)
    {
        $model = new TypeOperationModel();
        $BaremeFraismodel = new BaremeFraisModel();
        $data['typeOperation'] = $model->find($id);
        $data['baremeFrais'] = $BaremeFraismodel->getByIdTypeOperation($id);
        return view('operateur/typeOperations/modif', $data);
    }

    public function update()
    {
        $typeOperationModel = new TypeOperationModel();
        $baremeFraisModel   = new BaremeFraisModel();

        $dataTypeOperation = [
            'id'       => $this->request->getPost('id'),
            'libelle'  => $this->request->getPost('libelle'),
        ];

        $typeOperationModel->modifier($dataTypeOperation);

        $baremes = $this->request->getPost('baremes');

        foreach ($baremes as $bareme) {

            $baremeFraisModel->modifier([
                'id'            => $bareme['id'],
                'montant_min'   => $bareme['montant_min'],
                'montant_max'   => $bareme['montant_max'],
                'valeur'        => $bareme['valeur'],
            ]);
        }

        return redirect()->to(site_url('operateur/typesOperation'));
    }
}

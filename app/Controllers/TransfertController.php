<?php

namespace App\Controllers;

use App\Models\BaremeFraisModel;
use App\Models\ClientModel;
use App\Models\MouvementCompteModel;
use App\Models\TransactionModel;
use Config\Database;

class TransfertController extends BaseController
{
    public function index()
    {
        if (! $this->clientConnecte()) {
            return redirect()->to('/login');
        }

        $data = [
            'success' => session()->getFlashdata('success'),
            'error' => session()->getFlashdata('error'),
        ];

        return view('client/transfert', $data);
    }

    public function enregistrer()
    {
        if (! $this->clientConnecte()) {
            return redirect()->to('/login');
        }

        $telephoneDestination = preg_replace('/[^0-9]/', '', (string) $this->request->getPost('telephone_destination'));
        $montant = (float) ($this->request->getPost('montant') ?? 0);

        if ($telephoneDestination === '') {
            return redirect()->to('/transfert')->with('error', 'Veuillez saisir le téléphone du destinataire.');
        }

        if (! $this->montantValide($montant)) {
            return redirect()->to('/transfert')->with('error', 'Montant invalide. Le montant doit être supérieur à 0.');
        }

        $idClientSource = (int) session()->get('id_client');

        try {
            $destinataire = $this->destinataireExiste($telephoneDestination);

            if ($destinataire === null) {
                return redirect()->to('/transfert')->with('error', 'Destinataire introuvable.');
            }

            if (! $this->clientActif($destinataire)) {
                return redirect()->to('/transfert')->with('error', 'Destinataire inactif.');
            }

            $idClientDestination = (int) $destinataire['id'];

            if ($idClientDestination === $idClientSource) {
                return redirect()->to('/transfert')->with('error', 'Vous ne pouvez pas transférer de l’argent à vous-même.');
            }

            $baremeFraisModel = new BaremeFraisModel();
            $frais = $baremeFraisModel->chercherFraisTransfert($montant);

            if ($frais === null) {
                return redirect()->to('/transfert')->with('error', 'Aucun barème de frais trouvé pour ce montant.');
            }

            $montantTotal = $montant + $frais;

            if (! $this->soldeSuffisant($idClientSource, $montantTotal)) {
                return redirect()->to('/transfert')->with('error', 'Solde insuffisant pour effectuer ce transfert.');
            }

            $db = Database::connect();
            $db->transStart();

            $transactionModel = new TransactionModel();
            $idTransaction = $transactionModel->creerTransactionTransfert(
                $idClientSource,
                $idClientDestination,
                $montant,
                $frais
            );

            $mouvementModel = new MouvementCompteModel();
            $mouvementModel->creerMouvementDebit($idTransaction, $idClientSource, $montantTotal);
            $mouvementModel->creerMouvementCredit($idTransaction, $idClientDestination, $montant);

            $db->transComplete();

            if (! $db->transStatus()) {
                return redirect()->to('/transfert')->with('error', 'Une erreur est survenue lors du transfert.');
            }

            $message = 'Transfert effectué avec succès. Frais : ' . number_format($frais, 2, '.', ' ') . ' AR.';

            return redirect()->to('/transfert')->with('success', $message);
        } catch (\Exception $e) {
            return redirect()->to('/transfert')->with('error', 'Une erreur est survenue lors du transfert.');
        }
    }

    protected function clientConnecte(): bool
    {
        return (bool) session()->get('connecte');
    }

    protected function montantValide(float $montant): bool
    {
        return $montant > 0;
    }

    protected function destinataireExiste(string $telephone): ?array
    {
        $clientModel = new ClientModel();

        return $clientModel->chercherClientParTelephone($telephone);
    }

    protected function clientActif(array $client): bool
    {
        return (int) ($client['actif'] ?? 0) === 1;
    }

    protected function soldeSuffisant(int $idClient, float $montantTotal): bool
    {
        $mouvementModel = new MouvementCompteModel();
        $solde = $mouvementModel->calculerSolde($idClient);

        return $solde >= $montantTotal;
    }
}

<?php

namespace App\Controllers;

use App\Models\BaremeFraisModel;
use App\Models\ClientModel;
use App\Models\MouvementCompteModel;
use App\Models\TransactionDestinationModel;
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

        $destinataires = $this->extraireDestinatairesDepuisPost();
        $inclureFraisRetrait = $this->request->getPost('inclure_frais_retrait') !== null;

        if ($destinataires === []) {
            return redirect()->to('/transfert')->with('error', 'Veuillez saisir au moins un destinataire.');
        }

        foreach ($destinataires as $index => $destinataire) {
            if ($destinataire['telephone'] === '') {
                return redirect()->to('/transfert')->with('error', 'Veuillez saisir le téléphone du destinataire à la ligne ' . ($index + 1) . '.');
            }

            if (! $this->montantValide($destinataire['montant'])) {
                return redirect()->to('/transfert')->with('error', 'Montant invalide à la ligne ' . ($index + 1) . '. Le montant doit être supérieur à 0.');
            }
        }

        $idClientSource = (int) session()->get('id_client');

        try {
            $telephones = array_column($destinataires, 'telephone');

            if (count($telephones) !== count(array_unique($telephones))) {
                return redirect()->to('/transfert')->with('error', 'Un même destinataire ne peut pas être renseigné plusieurs fois.');
            }

            $clients = $this->chercherDestinataires($telephones);
            $clientsParTelephone = [];

            foreach ($clients as $client) {
                $clientsParTelephone[(string) $client['telephone']] = $client;
            }

            foreach ($destinataires as $index => $destinataire) {
                $telephone = $destinataire['telephone'];

                if (! isset($clientsParTelephone[$telephone])) {
                    return redirect()->to('/transfert')->with('error', 'Destinataire introuvable à la ligne ' . ($index + 1) . '.');
                }

                $client = $clientsParTelephone[$telephone];

                if (! $this->clientActif($client)) {
                    return redirect()->to('/transfert')->with('error', 'Destinataire inactif à la ligne ' . ($index + 1) . '.');
                }

                if ((int) $client['id'] === $idClientSource) {
                    return redirect()->to('/transfert')->with('error', 'Vous ne pouvez pas transférer de l’argent à vous-même.');
                }

                $destinataires[$index]['id_client'] = (int) $client['id'];
            }

            $montant = $this->calculerMontantDestinataires($destinataires);
            $baremeFraisModel = new BaremeFraisModel();
            $fraisTransfert = $baremeFraisModel->chercherFraisTransfert($montant);

            if ($fraisTransfert === null) {
                return redirect()->to('/transfert')->with('error', 'Aucun barème de frais trouvé pour le montant total.');
            }

            $fraisRetrait = 0.0;

            if ($inclureFraisRetrait) {
                foreach ($destinataires as $index => $destinataire) {
                    $fraisDestinataire = $baremeFraisModel->chercherFraisRetrait($destinataire['montant']);

                    if ($fraisDestinataire === null) {
                        return redirect()->to('/transfert')->with('error', 'Aucun barème de frais de retrait trouvé à la ligne ' . ($index + 1) . '.');
                    }

                    $fraisRetrait += $fraisDestinataire;
                }
            }

            $montantTotal = $this->calculerMontantTotal($montant, $fraisTransfert, $fraisRetrait, $inclureFraisRetrait);
            $fraisTransaction = $fraisTransfert + ($inclureFraisRetrait ? $fraisRetrait : 0);

            if (! $this->soldeSuffisant($idClientSource, $montantTotal)) {
                return redirect()->to('/transfert')->with('error', 'Solde insuffisant pour effectuer ce transfert.');
            }

            $db = Database::connect();
            $db->transStart();

            $transactionModel = new TransactionModel();
            $idTransaction = $transactionModel->creerTransactionMultiple(
                $idClientSource,
                $montant,
                $fraisTransaction
            );

            $transactionModel->mettreAJourFraisRetrait($idTransaction, $inclureFraisRetrait);

            $transactionDestinationModel = new TransactionDestinationModel();
            foreach ($destinataires as $destinataire) {
                $transactionDestinationModel->ajouterDestination(
                    $idTransaction,
                    (int) $destinataire['id_client'],
                    (float) $destinataire['montant']
                );
            }

            $mouvementModel = new MouvementCompteModel();
            $mouvementModel->creerMouvementDebit($idTransaction, $idClientSource, $montantTotal);
            $mouvementModel->creerMouvementsDestinataires($idTransaction, $destinataires);

            $db->transComplete();

            if (! $db->transStatus()) {
                return redirect()->to('/transfert')->with('error', 'Une erreur est survenue lors du transfert.');
            }

            $message = 'Transfert effectué avec succès vers ' . count($destinataires) . ' destinataire(s). Frais de transfert : '
                . number_format($fraisTransfert, 2, '.', ' ') . ' AR.';

            if ($inclureFraisRetrait) {
                $message .= ' Frais de retrait inclus : ' . number_format($fraisRetrait, 2, '.', ' ') . ' AR.';
            }

            return redirect()->to('/transfert')->with('success', $message);
        } catch (\Exception $e) {
            return redirect()->to('/transfert')->with('error', 'Une erreur est survenue lors du transfert.');
        }
    }

    protected function extraireDestinatairesDepuisPost(): array
    {
        $telephones = $this->request->getPost('telephone_destinations');
        $montants = $this->request->getPost('montants');

        if (! is_array($telephones)) {
            $telephones = [$this->request->getPost('telephone_destination')];
        }

        if (! is_array($montants)) {
            $montants = [$this->request->getPost('montant')];
        }

        $destinataires = [];
        $nombreLignes = max(count($telephones), count($montants));

        for ($i = 0; $i < $nombreLignes; $i++) {
            $telephoneBrut = trim((string) ($telephones[$i] ?? ''));
            $montantBrut = trim((string) ($montants[$i] ?? ''));

            if ($telephoneBrut === '' && $montantBrut === '') {
                continue;
            }

            $destinataires[] = [
                'telephone' => preg_replace('/[^0-9]/', '', $telephoneBrut),
                'montant' => (float) str_replace(',', '.', $montantBrut),
            ];
        }

        return $destinataires;
    }

    protected function clientConnecte(): bool
    {
        return (bool) session()->get('connecte');
    }

    protected function montantValide(float $montant): bool
    {
        return $montant > 0;
    }

    protected function calculerMontantTotal(float $montant, float $fraisTransfert, float $fraisRetrait, bool $inclure): float
    {
        return $montant + $fraisTransfert + ($inclure ? $fraisRetrait : 0);
    }

    protected function calculerMontantDestinataires(array $destinataires): float
    {
        $total = 0.0;

        foreach ($destinataires as $destinataire) {
            $total += (float) $destinataire['montant'];
        }

        return $total;
    }

    protected function chercherDestinataires(array $telephones): array
    {
        $clientModel = new ClientModel();

        return $clientModel->chercherClientsParTelephone($telephones);
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

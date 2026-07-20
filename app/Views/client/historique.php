<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historique des transactions</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f5f5f5; margin: 0; padding: 0; }
        .container { max-width: 900px; margin: 60px auto; padding: 24px; background: #fff; border-radius: 8px; box-shadow: 0 0 16px rgba(0,0,0,.08); }
        h1 { margin-top: 0; font-size: 24px; }
        .table-wrap { overflow-x: auto; }
        table { width: 100%; border-collapse: collapse; min-width: 680px; }
        th, td { padding: 12px; border-bottom: 1px solid #e5e5e5; text-align: left; }
        th { background: #f8f9fa; font-weight: bold; }
        .empty { padding: 16px; background: #f8f9fa; border-radius: 6px; color: #555; }
        .actions { margin-top: 20px; text-align: center; }
        .btn { display: inline-block; padding: 10px 16px; border-radius: 6px; text-decoration: none; color: #fff; margin: 0 8px; }
        .btn-primary { background: #007bff; }
        .btn-primary:hover { background: #0056b3; }
        .btn-secondary { background: #6c757d; }
        .btn-secondary:hover { background: #5a6268; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Historique des transactions</h1>

        <?php if (empty($transactions)): ?>
            <div class="empty">Aucune transaction trouvée.</div>
        <?php else: ?>
            <div class="table-wrap">
                <table>
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Type d'opération</th>
                            <th>Montant</th>
                            <th>Frais</th>
                            <th>Statut</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($transactions as $transaction): ?>
                            <tr>
                                <td><?= esc($transaction['date_transaction']) ?></td>
                                <td><?= esc($transaction['type_operation']) ?></td>
                                <td><?= number_format((float) $transaction['montant'], 2, '.', ' ') ?> AR</td>
                                <td><?= number_format((float) $transaction['frais'], 2, '.', ' ') ?> AR</td>
                                <td><?= esc($transaction['statut']) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>

        <div class="actions">
            <a href="/client/solde" class="btn btn-secondary">Retour</a>
            <a href="/client/logout" class="btn btn-primary">Déconnexion</a>
        </div>
    </div>
</body>
</html>

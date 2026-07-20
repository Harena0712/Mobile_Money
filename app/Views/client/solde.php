<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solde client</title>
</head>
<body>
    <div class="container">
        <h1>Solde du compte</h1>

        <div class="row">
            <div>Téléphone :</div>
            <div><?= esc($telephone) ?></div>
        </div>

        <div class="row" style="margin-top:16px;">
            <div>Solde :</div>
            <div class="solde"><?= number_format($solde, 2, '.', ' ') ?> AR</div>
        </div>

        <div class="actions">
            <a href="/" class="btn btn-secondary">Retour</a>
            <a href="/client/logout" class="btn btn-primary">Déconnexion</a>
        </div>
    </div>
</body>
</html>

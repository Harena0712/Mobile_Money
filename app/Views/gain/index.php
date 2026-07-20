<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Situation des gains</title>
</head>
<body>
    <main>
        <h1>Situation des gains</h1>

        <div>
            <p><strong>Total des frais :</strong> <?= esc($total_frais) ?> </p>
            <p><strong>Total des frais de transfert :</strong> <?= esc($total_frais_transfert) ?> </p>
            <p><strong>Total des frais de retrait :</strong> <?= esc($total_frais_retrait) ?> </p>
            <p><strong>Total des dépôts :</strong> <?= esc($total_depots) ?> </p>
            <p><strong>Total des transferts :</strong> <?= esc($total_transferts) ?> </p>
            <p><strong>Total des retraits :</strong> <?= esc($total_retraits) ?> </p>
            <p><strong>Total commissions inter-opérateurs :</strong> <?= esc($total_commissions_interoperateurs) ?> </p>
        </div>
    </main>
</body>
</html>

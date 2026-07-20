<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Montants à envoyer</title>
</head>
<body>
    <main>
        <h1>Montants à envoyer aux autres opérateurs</h1>

        <?php if (! empty($compensations)) : ?>
            <table>
                <thead>
                    <tr>
                        <th>Opérateur</th>
                        <th>Montant total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($compensations as $compensation) : ?>
                        <tr>
                            <td><?= esc($compensation['operateur']) ?></td>
                            <td><?= esc($compensation['total_montant']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else : ?>
            <p>Aucun montant à envoyer trouvé.</p>
        <?php endif; ?>
    </main>
</body>
</html>

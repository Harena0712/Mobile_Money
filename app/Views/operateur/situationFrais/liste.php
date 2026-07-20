<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Situation des frais</h1>
    <p>Total des transferts : <?= esc($totalTransfert) ?></p>
    <p>Total des retraits : <?= esc($totalRetrait) ?></p>
    <p>Total des frais : <?= esc($totalFrais) ?></p>

    <?php if (!empty($transactions) && is_array($transactions)) : ?>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Type d'opération</th>
                    <th>Frais</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($transactions as $transaction) : ?>
                    <tr>
                        <td><?= esc($transaction['id']) ?></td>
                        <td><?= esc($transaction['id_type_operation']) ?></td>
                        <td><?= esc($transaction['frais']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else : ?>
        <p>Aucune transaction trouvée.</p>
    <?php endif; ?>
</body>
</html>
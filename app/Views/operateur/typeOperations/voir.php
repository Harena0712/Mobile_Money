<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Type d'opération</h1>
    <p><strong>ID:</strong> <?= esc($typeOperation['id']) ?></p>
    <p><strong>Libellé:</strong> <?= esc($typeOperation['libelle']) ?></p>

    <?php if(!empty($baremeFrais) && is_array($baremeFrais)) : ?>
        <h2>Barème de frais</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Montant min</th>
                    <th>Montant max</th>
                    <th>Valeur</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($baremeFrais as $bareme) : ?>
                    <tr>
                        <td><?= esc($bareme['id']) ?></td>
                        <td><?= esc($bareme['montant_min']) ?></td>
                        <td><?= esc($bareme['montant_max']) ?></td>
                        <td><?= esc($bareme['valeur']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else : ?>
        <p>Aucun barème de frais trouvé pour ce type d'opération.</p>
    <?php endif; ?>

    <a href="<?= site_url('operateur/typesOperation/modif/' . $typeOperation['id']) ?>">Modifier</a>
</body>
</html>
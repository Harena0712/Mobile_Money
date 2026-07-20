<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php if (!empty($soldeClients) && is_array($soldeClients)) : ?>
        <table>
            <thead>
                <tr>
                    <th>ID Client</th>
                    <th>Solde</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($soldeClients as $compte) : ?>
                    <tr>
                        <td><?= esc($compte['id_client']) ?></td>
                        <td><?= esc($compte['solde']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else : ?>
        <p>Aucun compte trouvé.</p>
    <?php endif; ?>
</body>
</html>
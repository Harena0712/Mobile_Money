<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <a href="<?= site_url('operateur/prefixes/create') ?>">Ajouter un préfixe</a>
    <?php if (!empty($prefixes) && is_array($prefixes)) : ?>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Prefixe</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($prefixes as $prefixe) : ?>
                    <tr>
                        <td><?= esc($prefixe['id']) ?></td>
                        <td><?= esc($prefixe['prefixe']) ?></td>
                        <td>
                            <a href="<?= site_url('operateur/prefixes/modif/' . $prefixe['id']) ?>">Modifier</a>
                            <a href="<?= site_url('operateur/prefixes/delete/' . $prefixe['id']) ?>">Supprimer</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else : ?>
        <p>Aucun préfixe trouvé.</p>
    <?php endif; ?>
</body>
</html>
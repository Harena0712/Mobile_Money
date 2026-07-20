<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <a href="<?= site_url('operateur/typesOperation/create') ?>">Ajouter un type d'opération</a>
    <?php if (!empty($typeOperations) && is_array($typeOperations)) : ?>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Type d'opération</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($typeOperations as $typeOperation) : ?>
                    <tr>
                        <td><?= esc($typeOperation['id']) ?></td>
                        <td><?= esc($typeOperation['libelle']) ?></td>
                        <td>
                            <?php if(esc($typeOperation['id']) != 1): ?>
                                <a href="<?= site_url('operateur/typesOperation/voir/' . $typeOperation['id']) ?>">Voir</a>
                            <?php endif; ?>
                            <a href="<?= site_url('operateur/typesOperation/delete/' . $typeOperation['id']) ?>">Supprimer</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else : ?>
        <p>Aucun type d'opération trouvé.</p>
    <?php endif; ?>
</body>
</html>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des commissions</title>
</head>
<body>
    <main>
        <h1>Liste des commissions inter-opérateurs</h1>

        <?php if (session()->getFlashdata('success')) : ?>
            <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
        <?php endif; ?>

        <div class="actions">
            <a href="<?= site_url('commission/ajouter') ?>">Ajouter une commission</a>
        </div>

        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Opérateur source</th>
                    <th>Opérateur destination</th>
                    <th>Pourcentage</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (! empty($commissions)) : ?>
                    <?php foreach ($commissions as $commission) : ?>
                        <tr>
                            <td><?= esc($commission['id']) ?></td>
                            <td><?= esc($commission['operateur_source']) ?></td>
                            <td><?= esc($commission['operateur_destination']) ?></td>
                            <td><?= esc($commission['pourcentage']) ?>%</td>
                            <td>
                                <form action="<?= site_url('commission/modifier') ?>" method="post" style="display:inline-block;">
                                    <input type="hidden" name="id" value="<?= esc($commission['id']) ?>">
                                    <input type="hidden" name="id_operateur_source" value="<?= esc($commission['id_operateur_source']) ?>">
                                    <input type="hidden" name="id_operateur_destination" value="<?= esc($commission['id_operateur_destination']) ?>">
                                    <input type="text" name="pourcentage" value="<?= esc($commission['pourcentage']) ?>" required>
                                    <button type="submit">Modifier</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr>
                        <td colspan="5">Aucune commission trouvée.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </main>
</body>
</html>

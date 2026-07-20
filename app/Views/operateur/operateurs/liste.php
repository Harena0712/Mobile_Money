<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des opérateurs</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
</head>
<body>
    <main>
        <h1>Liste des opérateurs</h1>

        <?php if (session()->getFlashdata('success')) : ?>
            <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('error')) : ?>
            <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
        <?php endif; ?>

        <div class="actions">
            <a class="button" href="<?= site_url('operateur/ajouter') ?>">Ajouter un opérateur</a>
        </div>

        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nom</th>
                    <th>Statut</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (! empty($operateurs)) : ?>
                    <?php foreach ($operateurs as $operateur) : ?>
                        <tr>
                            <td><?= esc($operateur['id']) ?></td>
                            <td><?= esc($operateur['libelle']) ?></td>
                            <td><?= $operateur['actif'] ? 'Actif' : 'Inactif' ?></td>
                            <td>
                                <form action="<?= site_url('operateur/modifier') ?>" method="post" style="display:inline-block; margin-right:4px;">
                                    <input type="hidden" name="id" value="<?= esc($operateur['id']) ?>">
                                    <input type="text" name="nom" value="<?= esc($operateur['libelle']) ?>" placeholder="Nouveau nom" required>
                                    <button type="submit">Modifier</button>
                                </form>

                                <?php if ($operateur['actif']) : ?>
                                    <form action="<?= site_url('operateur/desactiver') ?>" method="post" style="display:inline-block; margin-right:4px;">
                                        <input type="hidden" name="id" value="<?= esc($operateur['id']) ?>">
                                        <button type="submit">Désactiver</button>
                                    </form>
                                <?php else : ?>
                                    <form action="<?= site_url('operateur/activer') ?>" method="post" style="display:inline-block; margin-right:4px;">
                                        <input type="hidden" name="id" value="<?= esc($operateur['id']) ?>">
                                        <button type="submit">Activer</button>
                                    </form>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr>
                        <td colspan="4">Aucun opérateur trouvé.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </main>
</body>
</html>

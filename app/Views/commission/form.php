<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter une commission</title>
</head>
<body>
    <main>
        <h1>Ajouter une commission inter-opérateur</h1>

        <form action="<?= site_url('commission/ajouter') ?>" method="post">
            <div>
                <label for="id_operateur_source">Opérateur source</label>
                <select name="id_operateur_source" id="id_operateur_source" required>
                    <option value="">Sélectionner</option>
                    <?php foreach ($operateurs as $operateur) : ?>
                        <option value="<?= esc($operateur['id']) ?>"><?= esc($operateur['libelle']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div>
                <label for="id_operateur_destination">Opérateur destination</label>
                <select name="id_operateur_destination" id="id_operateur_destination" required>
                    <option value="">Sélectionner</option>
                    <?php foreach ($operateurs as $operateur) : ?>
                        <option value="<?= esc($operateur['id']) ?>"><?= esc($operateur['libelle']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div>
                <label for="pourcentage">Pourcentage</label>
                <input type="number" step="0.01" min="0" name="pourcentage" id="pourcentage" required>
            </div>

            <button type="submit">Enregistrer</button>
        </form>
    </main>
</body>
</html>

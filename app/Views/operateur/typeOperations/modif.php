<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="<?= site_url('operateur/typesOperation/update') ?>" method="post">
        <?= csrf_field() ?>
        <input type="hidden" name="id" value="<?= esc($typeOperation['id']) ?>">
        <label for="libelle">Libellé :</label>
        <input type="text" name="libelle" id="libelle" value="<?= esc($typeOperation['libelle']) ?>" required>

        <?php foreach ($baremeFrais as $i => $bareme) : ?>

            <input type="hidden"
                name="baremes[<?= $i ?>][id]"
                value="<?= esc($bareme['id']) ?>">

            <label>Montant minimum :</label>
            <input
                type="number"
                name="baremes[<?= $i ?>][montant_min]"
                value="<?= esc($bareme['montant_min']) ?>"
                required>

            <label>Montant maximum :</label>
            <input
                type="number"
                name="baremes[<?= $i ?>][montant_max]"
                value="<?= esc($bareme['montant_max']) ?>"
                required>

            <label>Valeur :</label>
            <input
                type="number"
                name="baremes[<?= $i ?>][valeur]"
                value="<?= esc($bareme['valeur']) ?>"
                required>

            <hr>

        <?php endforeach; ?>
        <button type="submit">Modifier</button>
    </form>

</body>

</html>
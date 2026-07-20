<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="<?= site_url('operateur/prefixes/inserer') ?>" method="post">
        <?= csrf_field() ?>
        <label for="prefixe">Préfixe :</label>
        <input type="text" name="prefixe" id="prefixe" required>
        <button type="submit">Inserer</button>
    </form>
</body>

</html>
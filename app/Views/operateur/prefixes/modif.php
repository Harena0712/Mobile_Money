<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="<?= site_url('operateur/prefixes/update') ?>" method="post">
        <?= csrf_field() ?>
        <label for="prefixe">Préfixe :</label>
        <input type="text" name="prefixe" id="prefixe" value="<?= esc($prefixe['prefixe']) ?>" required>
        <input type="hidden" name="id" id="id" value="<?= esc($prefixe['id']) ?>" required>
        <button type="submit">Modifier</button>
    </form>
</body>
</html>
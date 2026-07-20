<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion client</title>
</head>
<body>
    <div class="container">
        <h1>Connexion client</h1>

        <?php if (!empty($error)): ?>
            <div class="message"><?= esc($error) ?></div>
        <?php endif; ?>

        <form action="/client/login" method="post">
            <?= csrf_field() ?>

            <div class="form-group">
                <label for="telephone">Téléphone</label>
                <input type="text" id="telephone" name="telephone" value="<?= set_value('telephone') ?>" placeholder="0612345678">
            </div>

            <button type="submit">Connexion</button>
        </form>
    </div>
</body>
</html>

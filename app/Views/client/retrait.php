<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Faire un retrait</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f5f5f5; margin: 0; padding: 0; }
        .container { max-width: 520px; margin: 60px auto; padding: 24px; background: #fff; border-radius: 8px; box-shadow: 0 0 16px rgba(0,0,0,.08); }
        h1 { margin-top: 0; font-size: 24px; }
        .message { margin-bottom: 16px; padding: 12px; border-radius: 6px; }
        .message.success { background: #d4edda; color: #155724; }
        .message.error { background: #ffe5e5; color: #9d2222; }
        .hint { color: #555; font-size: 14px; margin-bottom: 16px; }
        .form-group { margin-bottom: 16px; }
        label { display: block; margin-bottom: 8px; font-weight: bold; }
        input[type="number"] { width: 100%; padding: 10px 12px; border: 1px solid #ccc; border-radius: 6px; box-sizing: border-box; }
        .actions { margin-top: 20px; text-align: center; }
        .btn { display: inline-block; padding: 10px 16px; border-radius: 6px; text-decoration: none; color: #fff; border: none; cursor: pointer; margin: 0 8px; }
        .btn-primary { background: #dc3545; }
        .btn-primary:hover { background: #b02a37; }
        .btn-secondary { background: #6c757d; }
        .btn-secondary:hover { background: #5a6268; }
        button { width: 100%; padding: 12px; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Effectuer un retrait</h1>

        <?php if (!empty($success)): ?>
            <div class="message success"><?= esc($success) ?></div>
        <?php endif; ?>

        <?php if (!empty($error)): ?>
            <div class="message error"><?= esc($error) ?></div>
        <?php endif; ?>

        <p class="hint">Les frais sont calculés automatiquement selon le montant.</p>

        <form action="/client/retrait" method="post">
            <?= csrf_field() ?>

            <div class="form-group">
                <label for="montant">Montant (AR)</label>
                <input type="number" id="montant" name="montant" step="0.01" min="0.01" placeholder="0.00" value="<?= old('montant') ?>" required>
            </div>

            <button type="submit" class="btn btn-primary">Retirer</button>
        </form>

        <div class="actions">
            <a href="/client/solde" class="btn btn-secondary">Retour</a>
        </div>
    </div>
</body>
</html>

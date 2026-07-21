<?= $this->extend('client_layout') ?>

<?= $this->section('content') ?>

<div class="client-card">
    <h1>Configurer mon epargne</h1>
    <p class="client-subtitle">Configurer l' epragne de votre compte MoneyFlow.</p>

    <?php if (!empty($success)) : ?>
        <div class="alert alert-success"><?= esc($success) ?></div>
    <?php endif; ?>

    <?php if (!empty($error)) : ?>
        <div class="alert alert-error"><?= esc($error) ?></div>
    <?php endif; ?>


    <form action="/client/configurer-epargne" method="post">
        <?= csrf_field() ?>

        <div class="form-group">
            <label for="pourcentageEpargne">Epargne (%)</label>
            <input type="number" id="pourcentageEpargne" name="pourcentageEpargne" class="form-control" step="0.01" min="0.01" placeholder="0.00" value="<?= 0.0 ?>" required>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-primary">Configurer</button>
        </div>
    </form>

    <a href="/solde" class="back-link">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none"><path d="M19 12H5M12 19l-7-7 7-7" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
        Retour au solde
    </a>
</div>

<?= $this->endSection() ?>

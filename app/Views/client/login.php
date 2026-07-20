<?= $this->extend('client_layout') ?>

<?= $this->section('content') ?>

<div class="client-card">
    <div class="login-icon">
        <svg width="26" height="26" viewBox="0 0 24 24" fill="none"><rect x="6" y="2" width="12" height="20" rx="2.5" stroke="currentColor" stroke-width="1.8"/><path d="M11 18h2" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg>
    </div>

    <h1 style="text-align:center;">Connexion client</h1>
    <p class="client-subtitle" style="text-align:center;">Entrez votre numéro pour accéder à votre compte MoneyFlow.</p>

    <?php if (!empty($error)) : ?>
        <div class="alert alert-error"><?= esc($error) ?></div>
    <?php endif; ?>

    <form action="/login" method="post">
        <?= csrf_field() ?>

        <div class="form-group">
            <label for="telephone">Téléphone</label>
            <input type="text" id="telephone" name="telephone" class="form-control" value="<?= set_value('telephone') ?>" placeholder="0612345678">
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-primary">Connexion</button>
        </div>
    </form>
</div>

<?= $this->endSection() ?>

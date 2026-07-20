<?= $this->extend('client_layout') ?>

<?= $this->section('content') ?>

<div class="client-card">
    <h1>Effectuer un retrait</h1>
    <p class="client-subtitle">Retirez de l'argent de votre compte MoneyFlow.</p>

    <?php if (!empty($success)) : ?>
        <div class="alert alert-success"><?= esc($success) ?></div>
    <?php endif; ?>

    <?php if (!empty($error)) : ?>
        <div class="alert alert-error"><?= esc($error) ?></div>
    <?php endif; ?>

    <div class="client-hint">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" style="flex-shrink:0; margin-top:1px;"><circle cx="12" cy="12" r="9" stroke="currentColor" stroke-width="1.6"/><path d="M12 8v5M12 16h.01" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/></svg>
        Les frais sont calculés automatiquement selon le montant.
    </div>

    <form action="/retrait" method="post">
        <?= csrf_field() ?>

        <div class="form-group">
            <label for="montant">Montant (AR)</label>
            <input type="number" id="montant" name="montant" class="form-control" step="0.01" min="0.01" placeholder="0.00" value="<?= old('montant') ?>" required>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-accent">Retirer</button>
        </div>
    </form>

    <a href="/solde" class="back-link">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none"><path d="M19 12H5M12 19l-7-7 7-7" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
        Retour au solde
    </a>
</div>

<?= $this->endSection() ?>

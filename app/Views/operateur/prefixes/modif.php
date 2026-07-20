<?= $this->extend('layout') ?>

<?= $this->section('content') ?>

<div class="form-card">
    <form action="<?= site_url('operateur/prefixes/update') ?>" method="post">
        <?= csrf_field() ?>
        <input type="hidden" name="id" id="id" value="<?= esc($prefixe['id']) ?>" required>

        <div class="form-group">
            <label for="prefixe">Préfixe</label>
            <input type="text" name="prefixe" id="prefixe" class="form-control" value="<?= esc($prefixe['prefixe']) ?>" required>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-primary">Modifier</button>
            <a href="<?= site_url('/') ?>" class="btn btn-secondary">Annuler</a>
        </div>
    </form>
</div>

<?= $this->endSection() ?>

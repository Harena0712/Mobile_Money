<?= $this->extend('layout') ?>

<?= $this->section('content') ?>

<div class="form-card">
    <form action="<?= site_url('operateur/prefixes/inserer') ?>" method="post">
        <?= csrf_field() ?>

        <div class="form-group">
            <label for="prefixe">Préfixe</label>
            <input type="text" name="prefixe" id="prefixe" class="form-control" placeholder="Ex : 034" required>
            <p class="field-hint">Le préfixe identifie l'opérateur mobile money (ex : 034, 038...).</p>
        </div>

        <div class="form-group">
            <label for="id_operateur">Opérateur</label>
            <select name="id_operateur" id="id_operateur" class="form-control" required>
                <option value="">Sélectionnez un opérateur</option>
                <?php foreach ($operateurs as $operateur) : ?>
                    <option value="<?= esc($operateur['id']) ?>"><?= esc($operateur['libelle']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-primary">Insérer</button>
            <a href="<?= site_url('operateur/prefixes') ?>" class="btn btn-secondary">Annuler</a>
        </div>
    </form>
</div>

<?= $this->endSection() ?>

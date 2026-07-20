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

        <div class="form-group">
            <label for="id_operateur">Opérateur</label>
            <select name="id_operateur" id="id_operateur" class="form-control" required>
                <option value="">Selectionnez un operateur</option>
                <?php foreach ($operateurs as $operateur) : ?>
                    <option value="<?= esc($operateur['id']) ?>" <?= ($prefixe['id_operateur'] == $operateur['id']) ? 'selected' : '' ?>>
                        <?= esc($operateur['libelle']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>


        <div class="form-actions">
            <button type="submit" class="btn btn-primary">Modifier</button>
            <a href="<?= site_url('operateur/prefixes') ?>" class="btn btn-secondary">Annuler</a>
        </div>
    </form>
</div>

<?= $this->endSection() ?>

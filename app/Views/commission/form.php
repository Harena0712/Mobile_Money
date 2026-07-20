<?= $this->extend('layout') ?>

<?= $this->section('content') ?>

<div class="form-card" style="max-width: 720px;">
    <form action="<?= site_url('commission/ajouter') ?>" method="post">
        <?= csrf_field() ?>

        <div class="form-group">
            <label for="id_operateur_source">Opérateur source</label>
            <select name="id_operateur_source" id="id_operateur_source" class="form-control" required>
                <option value="">Sélectionner</option>
                <?php foreach ($operateurs as $operateur) : ?>
                    <option value="<?= esc($operateur['id']) ?>"><?= esc($operateur['libelle']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label for="id_operateur_destination">Opérateur destination</label>
            <select name="id_operateur_destination" id="id_operateur_destination" class="form-control" required>
                <option value="">Sélectionner</option>
                <?php foreach ($operateurs as $operateur) : ?>
                    <option value="<?= esc($operateur['id']) ?>"><?= esc($operateur['libelle']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label for="pourcentage">Pourcentage</label>
            <input type="number" step="0.01" min="0" name="pourcentage" id="pourcentage" class="form-control" required>
            <p class="field-hint">Pourcentage appliqué, exprimé en %.</p>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-primary">Enregistrer</button>
            <a href="<?= site_url('commission') ?>" class="btn btn-secondary">Annuler</a>
        </div>
    </form>
</div>

<?= $this->endSection() ?>

<?= $this->extend('layout') ?>

<?= $this->section('content') ?>

<div class="form-card" style="max-width: 720px;">
    <form action="<?= site_url('operateur/typesOperation/update') ?>" method="post">
        <?= csrf_field() ?>
        <input type="hidden" name="id" value="<?= esc($typeOperation['id']) ?>">

        <div class="form-group">
            <label for="libelle">Libellé</label>
            <input type="text" name="libelle" id="libelle" class="form-control" value="<?= esc($typeOperation['libelle']) ?>" required>
        </div>

        <div class="bareme-block">
            <h3>Barèmes de frais</h3>

            <?php foreach ($baremeFrais as $i => $bareme) : ?>
                <div class="bareme-row">
                    <input type="hidden" name="baremes[<?= $i ?>][id]" value="<?= esc($bareme['id']) ?>">

                    <div class="form-group">
                        <label>Montant minimum</label>
                        <input type="number" name="baremes[<?= $i ?>][montant_min]" class="form-control" value="<?= esc($bareme['montant_min']) ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Montant maximum</label>
                        <input type="number" name="baremes[<?= $i ?>][montant_max]" class="form-control" value="<?= esc($bareme['montant_max']) ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Valeur</label>
                        <input type="number" name="baremes[<?= $i ?>][valeur]" class="form-control" value="<?= esc($bareme['valeur']) ?>" required>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-primary">Modifier</button>
            <a href="<?= site_url('operateur/typesOperation') ?>" class="btn btn-secondary">Annuler</a>
        </div>
    </form>
</div>

<?= $this->endSection() ?>

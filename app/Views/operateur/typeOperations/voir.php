<?= $this->extend('layout') ?>

<?= $this->section('content') ?>

<div class="panel">
    <div class="panel-body">
        <div class="detail-list">
            <div class="detail-item"><span>Libellé</span><span><?= esc($typeOperation['libelle']) ?></span></div>
        </div>

        <?php if (!empty($baremeFrais) && is_array($baremeFrais)) : ?>
            <h3 style="font-size:14px; font-weight:700; margin:0 0 12px;">Barème de frais</h3>
            <div class="table-wrap">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Montant min</th>
                            <th>Montant max</th>
                            <th>Valeur</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($baremeFrais as $bareme) : ?>
                            <tr>
                                <td>#<?= esc($bareme['id']) ?></td>
                                <td><?= number_format((float) $bareme['montant_min'], 2, '.', ' ') ?> Ar</td>
                                <td><?= number_format((float) $bareme['montant_max'], 2, '.', ' ') ?> Ar</td>
                                <td><span class="badge badge-orange"><?= esc($bareme['valeur']) ?></span></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php else : ?>
            <div class="empty-state">
                <p>Aucun barème de frais trouvé pour ce type d'opération.</p>
            </div>
        <?php endif; ?>
    </div>
</div>

<div class="page-actions" style="justify-content:flex-start; margin-top:18px;">
    <a href="<?= site_url('operateur/typesOperation/modif/' . $typeOperation['id']) ?>" class="btn btn-primary">Modifier</a>
</div>

<?= $this->endSection() ?>

<?= $this->extend('layout') ?>

<?= $this->section('content') ?>

<?php if (session()->getFlashdata('success')) : ?>
    <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
<?php endif; ?>

<?php if (session()->getFlashdata('error')) : ?>
    <div class="alert alert-error"><?= session()->getFlashdata('error') ?></div>
<?php endif; ?>

<div class="page-actions">
    <a href="<?= site_url('operateur/ajouter') ?>" class="btn btn-primary">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none"><path d="M12 5v14M5 12h14" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
        Ajouter un opérateur
    </a>
</div>

<div class="panel">
    <div class="table-toolbar" style="display:flex; gap:12px; align-items:center; margin-bottom:12px; flex-wrap:wrap;">
        <input type="text" id="searchInput" class="form-control" placeholder="Rechercher un opérateur..." style="max-width:320px;">
    </div>

    <?php if (!empty($operateurs) && is_array($operateurs)) : ?>
        <div class="table-wrap">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nom</th>
                        <th>Statut</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($operateurs as $operateur) : ?>
                        <tr data-search="<?= esc($operateur['id'] . ' ' . $operateur['libelle']) ?>">
                            <td>#<?= esc($operateur['id']) ?></td>
                            <td><?= esc($operateur['libelle']) ?></td>
                            <td>
                                <?php if ($operateur['actif']) : ?>
                                    <span class="badge badge-green">Actif</span>
                                <?php else : ?>
                                    <span class="badge badge-orange">Inactif</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <div class="row-actions" style="flex-wrap:wrap; align-items:center;">
                                    <form action="<?= site_url('operateur/modifier') ?>" method="post" style="display:flex; gap:6px; align-items:center;">
                                        <input type="hidden" name="id" value="<?= esc($operateur['id']) ?>">
                                        <input type="text" name="nom" value="<?= esc($operateur['libelle']) ?>" class="form-control btn-sm" placeholder="Nouveau nom" required>
                                        <button type="submit" class="btn btn-secondary btn-sm">Modifier</button>
                                    </form>

                                    <?php if ($operateur['actif']) : ?>
                                        <form action="<?= site_url('operateur/desactiver') ?>" method="post">
                                            <input type="hidden" name="id" value="<?= esc($operateur['id']) ?>">
                                            <button type="submit" class="btn btn-danger btn-sm">Désactiver</button>
                                        </form>
                                    <?php else : ?>
                                        <form action="<?= site_url('operateur/activer') ?>" method="post">
                                            <input type="hidden" name="id" value="<?= esc($operateur['id']) ?>">
                                            <button type="submit" class="btn btn-accent btn-sm">Activer</button>
                                        </form>
                                    <?php endif; ?>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php else : ?>
        <div class="empty-state">
            <svg width="40" height="40" viewBox="0 0 24 24" fill="none"><rect x="3" y="4" width="18" height="16" rx="2" stroke="currentColor" stroke-width="1.6"/><path d="M8 10h8M8 14h5" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/></svg>
            <p>Aucun opérateur trouvé.</p>
        </div>
    <?php endif; ?>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.getElementById('searchInput');
    const rows = Array.from(document.querySelectorAll('.data-table tbody tr'));

    if (!searchInput || rows.length === 0) {
        return;
    }

    searchInput.addEventListener('input', function () {
        const term = this.value.trim().toLowerCase();

        rows.forEach(function (row) {
            const haystack = (row.dataset.search || '').toLowerCase();
            row.style.display = haystack.includes(term) ? '' : 'none';
        });
    });
});
</script>

<?= $this->endSection() ?>

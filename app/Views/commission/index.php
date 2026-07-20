<?= $this->extend('layout') ?>

<?= $this->section('content') ?>

<?php if (session()->getFlashdata('success')) : ?>
    <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
<?php endif; ?>

<?php if (session()->getFlashdata('error')) : ?>
    <div class="alert alert-error"><?= session()->getFlashdata('error') ?></div>
<?php endif; ?>

<div class="page-actions">
    <a href="<?= site_url('commission/ajouter') ?>" class="btn btn-primary">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none"><path d="M12 5v14M5 12h14" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
        Ajouter une commission
    </a>
</div>

<div class="panel">
    <div class="table-toolbar" style="display:flex; gap:12px; align-items:center; margin-bottom:12px; flex-wrap:wrap;">
        <input type="text" id="searchInput" class="form-control" placeholder="Rechercher une commission..." style="max-width:320px;">
    </div>

    <?php if (!empty($commissions) && is_array($commissions)) : ?>
        <div class="table-wrap">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Opérateur source</th>
                        <th>Opérateur destination</th>
                        <th>Pourcentage</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($commissions as $commission) : ?>
                        <tr data-search="<?= esc($commission['id'] . ' ' . $commission['operateur_source'] . ' ' . $commission['operateur_destination']) ?>">
                            <td>#<?= esc($commission['id']) ?></td>
                            <td><span class="badge badge-navy"><?= esc($commission['operateur_source']) ?></span></td>
                            <td><span class="badge badge-navy"><?= esc($commission['operateur_destination']) ?></span></td>
                            <td><span class="badge badge-green"><?= esc($commission['pourcentage']) ?> %</span></td>
                            <td>
                                <div class="row-actions" style="align-items:center;">
                                    <a href="<?= site_url('commission/modifier/' . $commission['id']) ?>" class="btn btn-secondary btn-sm">Modifier</a>
                                    <form action="<?= site_url('commission/supprimer/' . $commission['id']) ?>" method="post" onsubmit="return confirm('Supprimer cette commission ?');">
                                        <?= csrf_field() ?>
                                        <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
                                    </form>
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
            <p>Aucune commission trouvée.</p>
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

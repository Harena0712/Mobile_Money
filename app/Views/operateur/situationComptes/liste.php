<?= $this->extend('layout') ?>

<?= $this->section('content') ?>

<?php
    $nbComptes    = (!empty($soldeClients) && is_array($soldeClients)) ? count($soldeClients) : 0;
    $totalSoldes  = 0;
    if ($nbComptes > 0) {
        foreach ($soldeClients as $compte) {
            $totalSoldes += (float) $compte['solde'];
        }
    }
?>

<div class="stats-row">
    <div class="stat-card">
        <div class="stat-icon navy">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none"><rect x="3" y="10" width="18" height="9" rx="1.5" stroke="currentColor" stroke-width="1.8"/><path d="M3 10l9-6 9 6M7 14v2M12 14v2M17 14v2" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg>
        </div>
        <div>
            <p class="stat-label">Comptes clients</p>
            <p class="stat-value"><?= esc($nbComptes) ?></p>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon green">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none"><path d="M12 2v20M17 6.5c0-1.93-2.24-3.5-5-3.5s-5 1.57-5 3.5 2.24 3.5 5 3.5 5 1.57 5 3.5-2.24 3.5-5 3.5-5-1.57-5-3.5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg>
        </div>
        <div>
            <p class="stat-label">Solde cumulé</p>
            <p class="stat-value"><?= number_format($totalSoldes, 2, '.', ' ') ?> AR</p>
        </div>
    </div>
</div>

<div class="panel">
    <div class="table-toolbar" style="display:flex; gap:12px; align-items:center; margin-bottom:12px; flex-wrap:wrap;">
        <input type="text" id="searchInput" class="form-control" placeholder="Rechercher un client..." style="max-width:280px;">
    </div>

    <?php if (!empty($soldeClients) && is_array($soldeClients)) : ?>
        <div class="table-wrap">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>ID Client</th>
                        <th>Solde</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($soldeClients as $compte) : ?>
                        <tr data-search="<?= esc($compte['id_client'] . ' ' . $compte['solde']) ?>">
                            <td>#<?= esc($compte['id_client']) ?></td>
                            <td><span class="badge badge-navy"><?= number_format((float) $compte['solde'], 2, '.', ' ') ?> Ar</span></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php else : ?>
        <div class="empty-state">
            <svg width="40" height="40" viewBox="0 0 24 24" fill="none"><rect x="3" y="10" width="18" height="9" rx="1.5" stroke="currentColor" stroke-width="1.6"/><path d="M3 10l9-6 9 6" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/></svg>
            <p>Aucun compte trouvé.</p>
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

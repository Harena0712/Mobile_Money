<?= $this->extend('layout') ?>

<?= $this->section('content') ?>

<div class="stats-row">
    <div class="stat-card">
        <div class="stat-icon navy">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none"><path d="M12 2v20M17 6.5c0-1.93-2.24-3.5-5-3.5s-5 1.57-5 3.5 2.24 3.5 5 3.5 5 1.57 5 3.5-2.24 3.5-5 3.5-5-1.57-5-3.5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg>
        </div>
        <div>
            <p class="stat-label">Total des frais</p>
            <p class="stat-value"><?= number_format((float) $total_frais, 2, '.', ' ') ?> Ar</p>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon navy">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none"><path d="M17 7l-9.2 9.2M17 7v6M17 7h-6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
        </div>
        <div>
            <p class="stat-label">Total des frais de transfert</p>
            <p class="stat-value"><?= number_format((float) $total_frais_transfert, 2, '.', ' ') ?> Ar</p>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon orange">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none"><path d="M7 17l9.2-9.2M7 17v-6M7 17h6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
        </div>
        <div>
            <p class="stat-label">Total des frais de retrait</p>
            <p class="stat-value"><?= number_format((float) $total_frais_retrait, 2, '.', ' ') ?> Ar</p>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon green">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none"><path d="M12 5v14M5 12l7-7 7 7" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
        </div>
        <div>
            <p class="stat-label">Total des dépôts</p>
            <p class="stat-value"><?= number_format((float) $total_depots, 2, '.', ' ') ?> Ar</p>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon navy">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none"><path d="M17 7l-9.2 9.2M17 7v6M17 7h-6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
        </div>
        <div>
            <p class="stat-label">Total des transferts</p>
            <p class="stat-value"><?= number_format((float) $total_transferts, 2, '.', ' ') ?> Ar</p>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon orange">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none"><path d="M12 19V5M5 12l7 7 7-7" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
        </div>
        <div>
            <p class="stat-label">Total des retraits</p>
            <p class="stat-value"><?= number_format((float) $total_retraits, 2, '.', ' ') ?> Ar</p>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon green">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none"><path d="M4 19h16M7 15l5-5 5 5M12 4v11" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
        </div>
        <div>
            <p class="stat-label">Total commissions inter-opérateurs</p>
            <p class="stat-value"><?= number_format((float) $total_commissions_interoperateurs, 2, '.', ' ') ?> Ar</p>
        </div>
    </div>
</div>

<?php if (!empty($gains_par_operateur) && is_array($gains_par_operateur)) : ?>
    <div class="panel">
        <div class="table-toolbar" style="display:flex; gap:12px; align-items:center; margin-bottom:12px; flex-wrap:wrap;">
            <input type="text" id="searchInput" class="form-control" placeholder="Rechercher un opérateur..." style="max-width:320px;">
        </div>

        <div class="table-wrap">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Opérateur</th>
                        <th>Total frais</th>
                        <th>Frais transferts</th>
                        <th>Frais retraits</th>
                        <th>Dépôts</th>
                        <th>Transferts</th>
                        <th>Retraits</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($gains_par_operateur as $gain) : ?>
                        <tr data-search="<?= esc($gain['operateur']) ?>">
                            <td><span class="badge badge-navy"><?= esc($gain['operateur']) ?></span></td>
                            <td><?= number_format((float) $gain['total_frais'], 2, '.', ' ') ?> Ar</td>
                            <td><?= number_format((float) $gain['total_frais_transfert'], 2, '.', ' ') ?> Ar</td>
                            <td><?= number_format((float) $gain['total_frais_retrait'], 2, '.', ' ') ?> Ar</td>
                            <td><?= number_format((float) $gain['total_depots'], 2, '.', ' ') ?> Ar</td>
                            <td><?= number_format((float) $gain['total_transferts'], 2, '.', ' ') ?> Ar</td>
                            <td><?= number_format((float) $gain['total_retraits'], 2, '.', ' ') ?> Ar</td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
<?php else : ?>
    <div class="panel">
        <div class="empty-state">
            <svg width="40" height="40" viewBox="0 0 24 24" fill="none"><rect x="3" y="4" width="18" height="16" rx="2" stroke="currentColor" stroke-width="1.6"/><path d="M8 10h8M8 14h5" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/></svg>
            <p>Aucun gain par opérateur trouvé.</p>
        </div>
    </div>
<?php endif; ?>

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

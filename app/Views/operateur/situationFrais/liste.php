<?= $this->extend('layout') ?>

<?= $this->section('content') ?>

<div class="stats-row">
    <div class="stat-card">
        <div class="stat-icon green">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none"><path d="M17 7l-9.2 9.2M17 7v6M17 7h-6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
        </div>
        <div>
            <p class="stat-label">Total des transferts</p>
            <p class="stat-value"><?= number_format((float) $totalTransfert, 2, '.', ' ') ?> Ar</p>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon orange">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none"><path d="M7 17l9.2-9.2M7 17v-6M7 17h6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
        </div>
        <div>
            <p class="stat-label">Total des retraits</p>
            <p class="stat-value"><?= number_format((float) $totalRetrait, 2, '.', ' ') ?> Ar</p>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon navy">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none"><path d="M12 2v20M17 6.5c0-1.93-2.24-3.5-5-3.5s-5 1.57-5 3.5 2.24 3.5 5 3.5 5 1.57 5 3.5-2.24 3.5-5 3.5-5-1.57-5-3.5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg>
        </div>
        <div>
            <p class="stat-label">Total des frais</p>
            <p class="stat-value"><?= number_format((float) $totalFrais, 2, '.', ' ') ?> Ar</p>
        </div>
    </div>
</div>

<div class="panel">
    <div class="table-toolbar" style="display:flex; gap:12px; align-items:center; margin-bottom:12px; flex-wrap:wrap;">
        <input type="text" id="searchInput" class="form-control" placeholder="Rechercher une transaction..." style="max-width:320px;">
    </div>

    <?php if (!empty($transactions) && is_array($transactions)) : ?>
        <div class="table-wrap">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Type d'opération</th>
                        <th>Frais</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($transactions as $transaction) : ?>
                        <tr data-search="<?= esc($transaction['id'] . ' ' . $transaction['id_type_operation'] . ' ' . $transaction['frais']) ?>">
                            <td>#<?= esc($transaction['id']) ?></td>
                            <td><?= esc($transaction['id_type_operation']) ?></td>
                            <td><span class="badge badge-green"><?= number_format((float) $transaction['frais'], 2, '.', ' ') ?> Ar</span></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php else : ?>
        <div class="empty-state">
            <svg width="40" height="40" viewBox="0 0 24 24" fill="none"><rect x="3" y="4" width="18" height="16" rx="2" stroke="currentColor" stroke-width="1.6"/><path d="M8 10h8M8 14h5" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/></svg>
            <p>Aucune transaction trouvée.</p>
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

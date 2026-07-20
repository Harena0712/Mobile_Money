<?= $this->extend('client_layout') ?>

<?= $this->section('content') ?>

<div class="client-card">
    <h1>Historique des transactions</h1>
    <p class="client-subtitle">L'ensemble de vos opérations récentes.</p>

    <div class="table-toolbar" style="display:flex; gap:12px; align-items:center; margin-bottom:12px; flex-wrap:wrap;">
        <input type="text" id="searchInput" class="form-control" placeholder="Rechercher une transaction..." style="max-width:280px;">
        <select id="typeFilter" class="form-control" style="max-width:180px;">
            <option value="all">Tous les types</option>
            <option value="depot">Dépôt</option>
            <option value="retrait">Retrait</option>
            <option value="transfert">Transfert</option>
        </select>
    </div>

    <?php if (empty($transactions)) : ?>
        <div class="empty-state">
            <svg width="40" height="40" viewBox="0 0 24 24" fill="none"><rect x="3" y="4" width="18" height="16" rx="2" stroke="currentColor" stroke-width="1.6"/><path d="M8 10h8M8 14h5" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/></svg>
            <p>Aucune transaction trouvée.</p>
        </div>
    <?php else : ?>
        <div class="table-wrap">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Type</th>
                        <th>Montant</th>
                        <th>Frais</th>
                        <th>Statut</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($transactions as $transaction) : ?>
                        <tr data-search="<?= esc($transaction['date_transaction'] . ' ' . $transaction['type_operation'] . ' ' . $transaction['montant'] . ' ' . $transaction['frais'] . ' ' . $transaction['statut']) ?>" data-type="<?= esc(strtolower((string) $transaction['type_operation'])) ?>">
                            <td><?= esc($transaction['date_transaction']) ?></td>
                            <td><span class="badge badge-navy"><?= esc($transaction['type_operation']) ?></span></td>
                            <td><?= number_format((float) $transaction['montant'], 2, '.', ' ') ?> AR</td>
                            <td><?= number_format((float) $transaction['frais'], 2, '.', ' ') ?> AR</td>
                            <td><span class="badge badge-green"><?= esc($transaction['statut']) ?></span></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>

    <a href="/solde" class="back-link">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none"><path d="M19 12H5M12 19l-7-7 7-7" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
        Retour au solde
    </a>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.getElementById('searchInput');
    const typeFilter = document.getElementById('typeFilter');
    const rows = Array.from(document.querySelectorAll('.data-table tbody tr'));

    if (!searchInput || !typeFilter || rows.length === 0) {
        return;
    }

    function applyFilters() {
        const term = searchInput.value.trim().toLowerCase();
        const type = typeFilter.value;

        rows.forEach(function (row) {
            const haystack = (row.dataset.search || '').toLowerCase();
            const rowType = (row.dataset.type || '').toLowerCase();
            const matchesText = haystack.includes(term);
            const matchesType = type === 'all' || rowType === type;
            row.style.display = matchesText && matchesType ? '' : 'none';
        });
    }

    searchInput.addEventListener('input', applyFilters);
    typeFilter.addEventListener('change', applyFilters);
});
</script>

<?= $this->endSection() ?>

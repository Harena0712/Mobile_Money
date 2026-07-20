<?= $this->extend('layout') ?>

<?= $this->section('content') ?>

<div class="panel">
    <div class="table-toolbar" style="display:flex; gap:12px; align-items:center; margin-bottom:12px; flex-wrap:wrap;">
        <input type="text" id="searchInput" class="form-control" placeholder="Rechercher un opérateur..." style="max-width:320px;">
    </div>

    <?php if (!empty($transactions) && is_array($transactions)) : ?>
        <div class="table-wrap">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Opérateur</th>
                        <th>Date</th>
                        <th>Type d'opération</th>
                        <th>Montant</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($transactions as $transaction) : ?>
                        <tr data-search="<?= esc($transaction['operateur'] . ' ' . $transaction['type_operation']) ?>">
                            <td><?= esc($transaction['operateur']) ?></td>
                            <td><?= esc($transaction['date_transaction']) ?></td>
                            <td><?= esc($transaction['type_operation']) ?></td>
                            <td><span class="badge badge-orange"><?= number_format((float) $transaction['montant'], 2, '.', ' ') ?> Ar</span></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <h3 style="margin-top:24px;">Total à payer par opérateur</h3>
        <div class="table-wrap">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Opérateur</th>
                        <th>Montant total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($totaux_par_operateur as $total) : ?>
                        <tr>
                            <td><?= esc($total['operateur']) ?></td>
                            <td><span class="badge badge-orange"><?= number_format((float) $total['montant'], 2, '.', ' ') ?> Ar</span></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php else : ?>
        <div class="empty-state">
            <svg width="40" height="40" viewBox="0 0 24 24" fill="none"><rect x="3" y="4" width="18" height="16" rx="2" stroke="currentColor" stroke-width="1.6"/><path d="M8 10h8M8 14h5" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/></svg>
            <p>Aucun montant à envoyer trouvé.</p>
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

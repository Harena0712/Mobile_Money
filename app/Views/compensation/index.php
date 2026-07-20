<?= $this->extend('layout') ?>

<?= $this->section('content') ?>

<div class="panel">
    <div class="table-toolbar" style="display:flex; gap:12px; align-items:center; margin-bottom:12px; flex-wrap:wrap;">
        <input type="text" id="searchInput" class="form-control" placeholder="Rechercher un opérateur..." style="max-width:320px;">
    </div>

    <?php if (!empty($compensations) && is_array($compensations)) : ?>
        <div class="table-wrap">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Opérateur</th>
                        <th>Montant total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($compensations as $compensation) : ?>
                        <tr data-search="<?= esc($compensation['operateur']) ?>">
                            <td><?= esc($compensation['operateur']) ?></td>
                            <td><span class="badge badge-orange"><?= number_format((float) $compensation['total_montant'], 2, '.', ' ') ?> Ar</span></td>
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

<?= $this->extend('layout') ?>

<?= $this->section('content') ?>

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
                            <td><span class="badge badge-navy"><?= esc($compte['solde']) ?></span></td>
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

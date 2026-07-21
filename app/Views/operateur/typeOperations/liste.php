<?= $this->extend('layout') ?>

<?= $this->section('content') ?>

<div class="page-actions">
    <a href="<?= site_url('operateur/typesOperation/create') ?>" class="btn btn-primary">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none">
            <path d="M12 5v14M5 12h14" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
        </svg>
        Ajouter un type d'opération
    </a>
</div>

<div class="panel">
    <div class="table-toolbar" style="display:flex; gap:12px; align-items:center; margin-bottom:12px; flex-wrap:wrap;">
        <input type="text" id="searchInput" class="form-control" placeholder="Rechercher un type d'opération..." style="max-width:320px;">
    </div>

    <?php if (!empty($typeOperations) && is_array($typeOperations)) : ?>
        <div class="table-wrap">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Type d'opération</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($typeOperations as $typeOperation) : ?>
                        <tr data-search="<?= esc($typeOperation['id'] . ' ' . $typeOperation['libelle']) ?>">
                            <td>#<?= esc($typeOperation['id']) ?></td>
                            <td><span class="badge badge-green"><?= esc($typeOperation['libelle']) ?></span></td>
                            <td>
                                <div class="row-actions">
                                    <a href="<?= site_url('operateur/typesOperation/voir/' . $typeOperation['id']) ?>" class="btn btn-secondary btn-sm">Voir</a>
                                    <a href="<?= site_url('operateur/typesOperation/delete/' . $typeOperation['id']) ?>" class="btn btn-danger btn-sm"
                                        onclick="return confirm('Supprimer ce type d\'opération ?');">Supprimer</a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php else : ?>
        <div class="empty-state">
            <svg width="40" height="40" viewBox="0 0 24 24" fill="none">
                <rect x="3" y="4" width="18" height="16" rx="2" stroke="currentColor" stroke-width="1.6" />
                <path d="M8 10h8M8 14h5" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" />
            </svg>
            <p>Aucun type d'opération trouvé.</p>
        </div>
    <?php endif; ?>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('searchInput');
        const rows = Array.from(document.querySelectorAll('.data-table tbody tr'));

        if (!searchInput || rows.length === 0) {
            return;
        }

        searchInput.addEventListener('input', function() {
            const term = this.value.trim().toLowerCase();

            rows.forEach(function(row) {
                const haystack = (row.dataset.search || '').toLowerCase();
                row.style.display = haystack.includes(term) ? '' : 'none';
            });
        });
    });
</script>

<?= $this->endSection() ?>
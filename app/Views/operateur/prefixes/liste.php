<?= $this->extend('layout') ?>

<?= $this->section('content') ?>

<div class="page-actions">
    <a href="<?= site_url('operateur/prefixes/create') ?>" class="btn btn-primary">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none"><path d="M12 5v14M5 12h14" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
        Ajouter un préfixe
    </a>
</div>

<div class="panel">
    <?php if (!empty($prefixes) && is_array($prefixes)) : ?>
        <div class="table-wrap">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Préfixe</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($prefixes as $prefixe) : ?>
                        <tr>
                            <td>#<?= esc($prefixe['id']) ?></td>
                            <td><span class="badge badge-navy"><?= esc($prefixe['prefixe']) ?></span></td>
                            <td>
                                <div class="row-actions">
                                    <a href="<?= site_url('operateur/prefixes/modif/' . $prefixe['id']) ?>" class="btn btn-secondary btn-sm">Modifier</a>
                                    <a href="<?= site_url('operateur/prefixes/delete/' . $prefixe['id']) ?>" class="btn btn-danger btn-sm"
                                       onclick="return confirm('Supprimer ce préfixe ?');">Supprimer</a>
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
            <p>Aucun préfixe trouvé.</p>
        </div>
    <?php endif; ?>
</div>

<?= $this->endSection() ?>

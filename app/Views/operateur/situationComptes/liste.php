<?= $this->extend('layout') ?>

<?= $this->section('content') ?>

<div class="panel">
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
                        <tr>
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

<?= $this->endSection() ?>

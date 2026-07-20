<?= $this->extend('client_layout') ?>

<?= $this->section('content') ?>

<div class="client-card">
    <h1>Historique des transactions</h1>
    <p class="client-subtitle">L'ensemble de vos opérations récentes.</p>

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
                        <tr>
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

<?= $this->endSection() ?>

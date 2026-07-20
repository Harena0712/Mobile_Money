<?= $this->extend('client_layout') ?>

<?= $this->section('content') ?>

<div class="balance-hero">
    <p class="balance-label">Solde disponible</p>
    <p class="balance-value"><?= number_format($solde, 2, '.', ' ') ?> AR</p>
    <div class="balance-phone">
        <svg width="15" height="15" viewBox="0 0 24 24" fill="none"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07 19.5 19.5 0 01-6-6 19.79 19.79 0 01-3.07-8.67A2 2 0 014.11 2h3a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L8.09 9.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0122 16.92z" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/></svg>
        <?= esc($telephone) ?>
    </div>
</div>

<div class="quick-actions">
    <a href="/depot" class="quick-action">
        <span class="qa-icon green">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none"><path d="M12 5v14M5 12l7-7 7 7" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
        </span>
        Dépôt
    </a>
    <a href="/retrait" class="quick-action">
        <span class="qa-icon orange">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none"><path d="M12 19V5M5 12l7 7 7-7" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
        </span>
        Retrait
    </a>
    <a href="/transfert" class="quick-action">
        <span class="qa-icon navy">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none"><path d="M17 7l-9.2 9.2M17 7v6M17 7h-6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
        </span>
        Transfert
    </a>
</div>

<div class="client-card">
    <a href="/historique" class="quick-action" style="flex-direction:row; justify-content:flex-start; box-shadow:none;">
        <span class="qa-icon navy">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none"><path d="M3 3v5h5M3.05 13A9 9 0 106 5.3L3 8" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
        </span>
        Voir l'historique des transactions
    </a>
</div>

<?= $this->endSection() ?>

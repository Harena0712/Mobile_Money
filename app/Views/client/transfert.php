<?= $this->extend('client_layout') ?>

<?= $this->section('content') ?>

<?php
$oldTelephones = old('telephone_destinations');
$oldMontants = old('montants');

if (! is_array($oldTelephones)) {
    $oldTelephones = [old('telephone_destination')];
}

if (! is_array($oldMontants)) {
    $oldMontants = [old('montant')];
}

$nombreDestinataires = max(count($oldTelephones), count($oldMontants), 1);
?>

<div class="client-card">
    <h1>Effectuer un transfert</h1>
    <p class="client-subtitle">Envoyez de l'argent à un autre client MoneyFlow.</p>

    <?php if (!empty($success)) : ?>
        <div class="alert alert-success"><?= esc($success) ?></div>
    <?php endif; ?>

    <?php if (!empty($error)) : ?>
        <div class="alert alert-error"><?= esc($error) ?></div>
    <?php endif; ?>

    <div class="client-hint">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" style="flex-shrink:0; margin-top:1px;"><circle cx="12" cy="12" r="9" stroke="currentColor" stroke-width="1.6"/><path d="M12 8v5M12 16h.01" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/></svg>
        Les frais sont calculés automatiquement selon le montant transféré.
    </div>

    <form action="/transfert" method="post">
        <?= csrf_field() ?>

        <div class="destinataires-header">
            <h2>Destinataires</h2>
            <button type="button" class="btn btn-secondary btn-sm" id="addDestination">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none"><path d="M12 5v14M5 12h14" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
                Ajouter
            </button>
        </div>

        <div class="destinataires-list" id="destinationsList">
            <?php for ($i = 0; $i < $nombreDestinataires; $i++) : ?>
                <div class="destinataire-row">
                    <div class="destinataire-fields">
                        <div class="form-group">
                            <label>Téléphone du destinataire</label>
                            <input type="tel" name="telephone_destinations[]" class="form-control" placeholder="0340000000" value="<?= esc((string) ($oldTelephones[$i] ?? '')) ?>" required>
                        </div>

                        <div class="form-group">
                            <label>Montant (AR)</label>
                            <input type="number" name="montants[]" class="form-control" step="0.01" min="0.01" placeholder="0.00" value="<?= esc((string) ($oldMontants[$i] ?? '')) ?>" required>
                        </div>
                    </div>

                    <button type="button" class="icon-btn remove-destination" aria-label="Retirer ce destinataire">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none"><path d="M18 6L6 18M6 6l12 12" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
                    </button>
                </div>
            <?php endfor; ?>
        </div>

        <div class="form-group">
            <label style="display:flex; align-items:center; gap:10px; font-weight:600;">
                <input type="checkbox" name="inclure_frais_retrait" value="1" <?= old('inclure_frais_retrait') ? 'checked' : '' ?>>
                Inclure les frais de retrait
            </label>
            <p class="client-subtitle" style="margin:8px 0 0;">Si cette option est cochée, les frais de retrait seront ajoutés au montant total débité.</p>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-primary">Transférer</button>
        </div>
    </form>

    <a href="/solde" class="back-link">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none"><path d="M19 12H5M12 19l-7-7 7-7" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
        Retour au solde
    </a>
</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const list = document.getElementById('destinationsList');
    const addButton = document.getElementById('addDestination');

    if (!list || !addButton) {
        return;
    }

    function updateRemoveButtons() {
        const rows = list.querySelectorAll('.destinataire-row');
        rows.forEach(function (row) {
            const button = row.querySelector('.remove-destination');
            if (button) {
                button.disabled = rows.length === 1;
            }
        });
    }

    function createRow() {
        const row = document.createElement('div');
        row.className = 'destinataire-row';
        row.innerHTML = `
            <div class="destinataire-fields">
                <div class="form-group">
                    <label>Téléphone du destinataire</label>
                    <input type="tel" name="telephone_destinations[]" class="form-control" placeholder="0340000000" required>
                </div>

                <div class="form-group">
                    <label>Montant (AR)</label>
                    <input type="number" name="montants[]" class="form-control" step="0.01" min="0.01" placeholder="0.00" required>
                </div>
            </div>

            <button type="button" class="icon-btn remove-destination" aria-label="Retirer ce destinataire">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none"><path d="M18 6L6 18M6 6l12 12" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
            </button>
        `;

        return row;
    }

    addButton.addEventListener('click', function () {
        list.appendChild(createRow());
        updateRemoveButtons();
        const rows = list.querySelectorAll('.destinataire-row');
        rows[rows.length - 1].querySelector('input')?.focus();
    });

    list.addEventListener('click', function (event) {
        const button = event.target.closest('.remove-destination');

        if (!button || button.disabled) {
            return;
        }

        button.closest('.destinataire-row')?.remove();
        updateRemoveButtons();
    });

    updateRemoveButtons();
});
</script>
<?= $this->endSection() ?>

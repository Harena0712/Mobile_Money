<?= $this->extend('layout') ?>

<?= $this->section('content') ?>

<div class="form-card" style="max-width: 720px;">
    <form action="<?= site_url('operateur/typesOperation/inserer') ?>" method="post">
        <?= csrf_field() ?>

        <div class="form-group">
            <label for="libelle">Type d'opération</label>
            <input type="text" name="libelle" id="libelle" class="form-control" placeholder="Ex : Transfert, Retrait..." required>
        </div>

        <div class="bareme-block">
            <h3>Barèmes de frais</h3>

            <div id="baremes">
                <div class="bareme-row">
                    <div class="form-group">
                        <label>Montant minimum</label>
                        <input type="number" name="baremes[0][montant_min]" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Montant maximum</label>
                        <input type="number" name="baremes[0][montant_max]" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Valeur</label>
                        <input type="number" name="baremes[0][valeur]" class="form-control" required>
                    </div>
                </div>
            </div>

            <button type="button" class="add-row-btn" onclick="ajouterLigne()">+ Ajouter une tranche</button>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-primary">Ajouter</button>
            <a href="<?= site_url('operateur/typesOperation') ?>" class="btn btn-secondary">Annuler</a>
        </div>
    </form>
</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    let index = 1;

    function ajouterLigne() {
        const container = document.getElementById("baremes");
        const div = document.createElement("div");
        div.classList.add("bareme-row");

        div.innerHTML = `
            <div class="form-group">
                <label>Montant minimum</label>
                <input type="number" name="baremes[${index}][montant_min]" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Montant maximum</label>
                <input type="number" name="baremes[${index}][montant_max]" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Valeur</label>
                <input type="number" name="baremes[${index}][valeur]" class="form-control" required>
            </div>
            <button type="button" class="btn btn-danger btn-sm" onclick="supprimerLigne(this)">Supprimer</button>
        `;

        container.appendChild(div);
        index++;
    }

    function supprimerLigne(button) {
        button.parentElement.remove();
    }
</script>
<?= $this->endSection() ?>

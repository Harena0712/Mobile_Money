<?= $this->extend('client_layout') ?>

<?= $this->section('content') ?>

<div class="client-card">
    <h1>Historique des transactions</h1>
    <p class="client-subtitle">L'ensemble de vos opérations récentes.</p>

    <div class="table-toolbar" style="display:flex; gap:12px; align-items:center; margin-bottom:12px; flex-wrap:wrap;">
        <input type="text" id="searchInput" class="form-control" placeholder="Rechercher une transaction..." style="max-width:280px;">
        <select id="typeFilter" class="form-control" style="max-width:180px;">
            <option value="all">Tous les types</option>
            <option value="depot">Dépôt</option>
            <option value="retrait">Retrait</option>
            <option value="transfert">Transfert</option>
        </select>
    </div>

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
                        <tr data-search="<?= esc($transaction['date_transaction'] . ' ' . $transaction['type_operation'] . ' ' . $transaction['montant'] . ' ' . $transaction['frais'] . ' ' . $transaction['statut']) ?>" data-type="<?= esc(strtolower((string) $transaction['type_operation'])) ?>">
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

        <div id="pagination" class="table-pagination"></div>

    <?php endif; ?>

    <a href="/solde" class="back-link">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none"><path d="M19 12H5M12 19l-7-7 7-7" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
        Retour au solde
    </a>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {

    const searchInput = document.getElementById('searchInput');
    const typeFilter = document.getElementById('typeFilter');
    const rows = Array.from(document.querySelectorAll('.data-table tbody tr'));
    const pagination = document.getElementById('pagination');

    if (!searchInput || !typeFilter || rows.length === 0) {
        return;
    }

    const lignesParPage = 10;
    let pageCourante = 1;

    function applyFilters() {

        const term = searchInput.value.trim().toLowerCase();
        const type = typeFilter.value;

        const filtrees = rows.filter(function(row){

            const texte = (row.dataset.search || '').toLowerCase();
            const rowType = (row.dataset.type || '').toLowerCase();

            return texte.includes(term)
                && (type === 'all' || rowType === type);

        });

        afficherPage(filtrees);
    }

    function afficherPage(filtrees){

        const totalPages = Math.max(
            1,
            Math.ceil(filtrees.length / lignesParPage)
        );

        if(pageCourante > totalPages){
            pageCourante = totalPages;
        }

        const debut = (pageCourante - 1) * lignesParPage;

        const visibles = filtrees.slice(
            debut,
            debut + lignesParPage
        );

        rows.forEach(function(row){
            row.style.display = visibles.includes(row) ? '' : 'none';
        });

        pagination.innerHTML = '';

        ajouterBouton('Précédent', pageCourante > 1, function(){
            pageCourante--;
            afficherPage(filtrees);
        });

        for(let i=1; i<=totalPages; i++){

            ajouterBouton(
                i,
                true,
                function(){

                    pageCourante = i;
                    afficherPage(filtrees);

                },
                i === pageCourante
            );

        }

        ajouterBouton('Suivant', pageCourante < totalPages, function(){
            pageCourante++;
            afficherPage(filtrees);
        });

    }

    function ajouterBouton(texte, actif, action, courant = false){

        const btn = document.createElement('button');

        btn.textContent = texte;

        btn.className = 'pagination-button';

        if(courant){
            btn.classList.add('active');
        }

        btn.disabled = !actif;

        if(actif){
            btn.onclick = action;
        }

        pagination.appendChild(btn);

    }

    searchInput.addEventListener('input', function(){

        pageCourante = 1;
        applyFilters();

    });

    typeFilter.addEventListener('change', function(){

        pageCourante = 1;
        applyFilters();

    });

    applyFilters();

});
</script>

<?= $this->endSection() ?>

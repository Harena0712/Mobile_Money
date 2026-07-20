<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MoneyFlow · Choisir un espace</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
</head>
<body class="choice-body">
    <main class="choice-shell">
        <div class="choice-brand">
            <span class="brand-mark">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none">
                    <rect x="2" y="5" width="20" height="14" rx="3" stroke="currentColor" stroke-width="1.8"/>
                    <path d="M2 9.5H22" stroke="currentColor" stroke-width="1.8"/>
                    <circle cx="17" cy="14.5" r="1.6" fill="currentColor"/>
                </svg>
            </span>
            <span class="brand-name">MoneyFlow</span>
        </div>

        <section class="choice-card">
            <div class="choice-heading">
                <h1>Choisir un espace</h1>
                <p>Connectez-vous selon votre rôle.</p>
            </div>

            <div class="choice-actions">
                <a href="<?= site_url('operateur/prefixes') ?>" class="choice-option">
                    <span class="choice-icon navy">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none">
                            <path d="M4 6h16M4 12h10M4 18h7" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
                        </svg>
                    </span>
                    <span>
                        <strong>Opérateur</strong>
                        <small>Gestion des préfixes, frais et comptes.</small>
                    </span>
                </a>

                <a href="<?= site_url('client/login') ?>" class="choice-option">
                    <span class="choice-icon green">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none">
                            <rect x="6" y="2" width="12" height="20" rx="2.5" stroke="currentColor" stroke-width="1.8"/>
                            <path d="M10 18h4" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
                        </svg>
                    </span>
                    <span>
                        <strong>Client</strong>
                        <small>Solde, dépôt, retrait et transfert.</small>
                    </span>
                </a>
            </div>
        </section>
    </main>
</body>
</html>

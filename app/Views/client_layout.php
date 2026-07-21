<?php
$isLoginPage = strpos(current_url(), '/login') !== false;
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($title) ? esc($title) . ' · MoneyFlow' : 'MoneyFlow' ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
</head>
<body class="client-body">

<?php if ($isLoginPage) : ?>

    <!-- ===== ÉCRAN DE CONNEXION (pas de sidebar) ===== -->
    <div class="auth-shell">
        <main class="auth-content">
            <div class="auth-brand">
                <span class="brand-mark">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <rect x="2" y="5" width="20" height="14" rx="3" stroke="currentColor" stroke-width="1.8"/>
                        <path d="M2 9.5H22" stroke="currentColor" stroke-width="1.8"/>
                        <circle cx="17" cy="14.5" r="1.6" fill="currentColor"/>
                    </svg>
                </span>
                <span class="brand-name">MoneyFlow</span>
            </div>

            <?= $this->renderSection('content') ?>
        </main>
    </div>

<?php else : ?>

    <div class="app-shell">

        <!-- ===== SIDEBAR CLIENT ===== -->
        <aside class="sidebar sidebar-client" id="sidebar">
            <div class="sidebar-brand">
                <span class="brand-mark">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <rect x="2" y="5" width="20" height="14" rx="3" stroke="currentColor" stroke-width="1.8"/>
                        <path d="M2 9.5H22" stroke="currentColor" stroke-width="1.8"/>
                        <circle cx="17" cy="14.5" r="1.6" fill="currentColor"/>
                    </svg>
                </span>
                <span class="brand-name">MoneyFlow</span>
            </div>

            <button class="sidebar-close" id="sidebarClose" aria-label="Fermer le menu">&times;</button>

            <nav class="sidebar-nav">
                <p class="nav-group-title">Mon compte</p>

                <a href="/solde"
                   class="nav-link <?= strpos(current_url(), '/solde') !== false ? 'active' : '' ?>">
                    <span class="nav-icon">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none"><rect x="2" y="6" width="20" height="14" rx="3" stroke="currentColor" stroke-width="1.8"/><path d="M2 11h20" stroke="currentColor" stroke-width="1.8"/></svg>
                    </span>
                    Mon solde
                </a>

                <p class="nav-group-title">Opérations</p>

                <a href="/depot"
                   class="nav-link <?= strpos(current_url(), '/depot') !== false ? 'active' : '' ?>">
                    <span class="nav-icon">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none"><path d="M12 5v14M5 12l7-7 7 7" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    </span>
                    Dépôt
                </a>

                <a href="/retrait"
                   class="nav-link <?= strpos(current_url(), '/retrait') !== false ? 'active' : '' ?>">
                    <span class="nav-icon">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none"><path d="M12 19V5M5 12l7 7 7-7" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    </span>
                    Retrait
                </a>

                <a href="/transfert"
                   class="nav-link <?= strpos(current_url(), '/transfert') !== false ? 'active' : '' ?>">
                    <span class="nav-icon">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none"><path d="M17 7l-9.2 9.2M17 7v6M17 7h-6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    </span>
                    Transfert
                </a>

                <a href="/client/epargne"
                   class="nav-link <?= strpos(current_url(), '/epargne') !== false ? 'active' : '' ?>">
                    <span class="nav-icon">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none"><path d="M17 7l-9.2 9.2M17 7v6M17 7h-6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    </span>
                    Configurer mon epargne
                </a>

                <p class="nav-group-title">Suivi</p>

                <a href="/historique"
                   class="nav-link <?= strpos(current_url(), '/historique') !== false ? 'active' : '' ?>">
                    <span class="nav-icon">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none"><path d="M3 3v5h5M3.05 13A9 9 0 106 5.3L3 8" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    </span>
                    Historique
                </a>
            </nav>

            <div class="sidebar-footer">
                <?php if (isset($telephone)) : ?>
                    <div class="client-chip">
                        <span class="client-avatar">
                            <svg width="15" height="15" viewBox="0 0 24 24" fill="none"><rect x="6" y="2" width="12" height="20" rx="2.5" stroke="currentColor" stroke-width="1.8"/></svg>
                        </span>
                        <div class="client-meta">
                            <span class="client-name">Espace Client</span>
                            <span class="client-sub"><?= esc($telephone) ?></span>
                        </div>
                    </div>
                <?php endif; ?>

                <a href="/logout" class="sidebar-logout">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none"><path d="M9 21H5a2 2 0 01-2-2V5a2 2 0 012-2h4M16 17l5-5-5-5M21 12H9" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    Déconnexion
                </a>
            </div>
        </aside>

        <div class="sidebar-overlay" id="sidebarOverlay"></div>

        <!-- ===== MAIN ===== -->
        <div class="main-area">
            <header class="topbar">
                <button class="menu-toggle" id="menuToggle" aria-label="Ouvrir le menu">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none"><path d="M3 6h18M3 12h18M3 18h18" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
                </button>
                <div class="topbar-title">
                    <h1><?= isset($title) ? esc($title) : 'Mon espace' ?></h1>
                    <?php if (isset($subtitle)) : ?>
                        <p><?= esc($subtitle) ?></p>
                    <?php endif; ?>
                </div>
            </header>

            <main class="content">
                <div class="client-content">
                    <?= $this->renderSection('content') ?>
                </div>
            </main>
        </div>
    </div>

<?php endif; ?>

<script>
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('sidebarOverlay');

    function openSidebar() {
        sidebar?.classList.add('open');
        overlay?.classList.add('visible');
    }
    function closeSidebar() {
        sidebar?.classList.remove('open');
        overlay?.classList.remove('visible');
    }

    document.getElementById('menuToggle')?.addEventListener('click', openSidebar);
    document.getElementById('sidebarClose')?.addEventListener('click', closeSidebar);
    overlay?.addEventListener('click', closeSidebar);
</script>

<?= $this->renderSection('scripts') ?>

</body>
</html>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($title) ? esc($title) . ' · MoneyFlow' : 'MoneyFlow · Espace Opérateur' ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
</head>

<body>

    <div class="app-shell">

        <!-- ===== SIDEBAR OPÉRATEUR ===== -->
        <aside class="sidebar" id="sidebar">
            <div class="sidebar-brand">
                <span class="brand-mark">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <rect x="2" y="5" width="20" height="14" rx="3" stroke="currentColor" stroke-width="1.8" />
                        <path d="M2 9.5H22" stroke="currentColor" stroke-width="1.8" />
                        <circle cx="17" cy="14.5" r="1.6" fill="currentColor" />
                    </svg>
                </span>
                <span class="brand-name">MoneyFlow</span>
            </div>

            <button class="sidebar-close" id="sidebarClose" aria-label="Fermer le menu">&times;</button>

            <nav class="sidebar-nav">
                <p class="nav-group-title">Opérations</p>

                <a href="<?= site_url('/') ?>"
                    class="nav-link <?= strpos(current_url(), 'prefixes') !== false ? 'active' : '' ?>">
                    <span class="nav-icon">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none">
                            <path d="M4 6h16M4 12h10M4 18h7" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" />
                        </svg>
                    </span>
                    Préfixes opérateurs
                </a>

                <a href="<?= site_url('operateur/typesOperation') ?>"
                    class="nav-link <?= strpos(current_url(), 'typesOperation') !== false ? 'active' : '' ?>">
                    <span class="nav-icon">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none">
                            <path d="M17 2l4 4-4 4M21 6H7a4 4 0 00-4 4M7 22l-4-4 4-4M3 18h14a4 4 0 004-4" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </span>
                    Types d'opérations
                </a>

                <p class="nav-group-title">Suivi &amp; contrôle</p>

                <a href="<?= site_url('operateur/situationFrais') ?>"
                    class="nav-link <?= strpos(current_url(), 'situationFrais') !== false ? 'active' : '' ?>">
                    <span class="nav-icon">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none">
                            <path d="M12 2v20M17 6.5c0-1.93-2.24-3.5-5-3.5s-5 1.57-5 3.5 2.24 3.5 5 3.5 5 1.57 5 3.5-2.24 3.5-5 3.5-5-1.57-5-3.5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" />
                        </svg>
                    </span>
                    Situation des frais
                </a>

                <a href="<?= site_url('operateur/situationComptes') ?>"
                    class="nav-link <?= strpos(current_url(), 'situationComptes') !== false ? 'active' : '' ?>">
                    <span class="nav-icon">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none">
                            <rect x="3" y="10" width="18" height="9" rx="1.5" stroke="currentColor" stroke-width="1.8" />
                            <path d="M3 10l9-6 9 6M7 14v2M12 14v2M17 14v2" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" />
                        </svg>
                    </span>
                    Situation des comptes
                </a>
            </nav>

            <div class="sidebar-footer">
                <div class="operator-chip">
                    <a href="<?= site_url('login') ?>" class="sidebar-footer-link">
                        <span class="operator-name">Déconnexion</span>
                        <span class="operator-sub">Se connecter en tant que client</span>
                    </a>
                </div>
        </aside>

        <div class="sidebar-overlay" id="sidebarOverlay"></div>

        <!-- ===== MAIN ===== -->
        <div class="main-area">
            <header class="topbar">
                <button class="menu-toggle" id="menuToggle" aria-label="Ouvrir le menu">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none">
                        <path d="M3 6h18M3 12h18M3 18h18" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                    </svg>
                </button>
                <div class="topbar-title">
                    <h1><?= isset($title) ? esc($title) : 'Tableau de bord' ?></h1>
                    <?php if (isset($subtitle)) : ?>
                        <p><?= esc($subtitle) ?></p>
                    <?php endif; ?>
                </div>
            </header>

            <main class="content">
                <?= $this->renderSection('content') ?>
            </main>
        </div>
    </div>

    <script>
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('sidebarOverlay');

        function openSidebar() {
            sidebar.classList.add('open');
            overlay.classList.add('visible');
        }

        function closeSidebar() {
            sidebar.classList.remove('open');
            overlay.classList.remove('visible');
        }

        document.getElementById('menuToggle')?.addEventListener('click', openSidebar);
        document.getElementById('sidebarClose')?.addEventListener('click', closeSidebar);
        overlay?.addEventListener('click', closeSidebar);
    </script>

    <?= $this->renderSection('scripts') ?>

</body>

</html>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="A session-protected CodeIgniter point-of-sale application.">
    <title><?= esc($title) ?> | Northstar POS</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/app.css') ?>">
</head>
<body>
    <header class="site-header">
        <div class="nav-shell">
            <a class="brand" href="<?= site_url('/') ?>" aria-label="Northstar POS home">
                <span class="brand-mark">N</span>
                <span><strong>Northstar</strong><small>Point of Sale</small></span>
            </a>
            <nav class="main-nav" aria-label="Primary navigation">
                <a class="<?= $activePage === 'home' ? 'active' : '' ?>" href="<?= site_url('/') ?>">Home</a>
                <a class="<?= $activePage === 'about' ? 'active' : '' ?>" href="<?= site_url('about') ?>">About</a>
                <?php if (session()->get('isLoggedIn')): ?>
                    <a class="<?= $activePage === 'customers' ? 'active' : '' ?>" href="<?= site_url('customers') ?>">Customers</a>
                    <a class="<?= $activePage === 'users' ? 'active' : '' ?>" href="<?= site_url('users') ?>">Users</a>
                    <form class="logout-form" method="post" action="<?= site_url('logout') ?>">
                        <?= csrf_field() ?>
                        <button type="submit">Logout</button>
                    </form>
                <?php else: ?>
                    <a class="<?= $activePage === 'login' ? 'active' : '' ?>" href="<?= site_url('login') ?>">Login</a>
                <?php endif; ?>
            </nav>
        </div>
    </header>
    <main><?= $this->renderSection('content') ?></main>
    <footer class="site-footer">
        <div class="footer-shell">
            <p><strong>Northstar POS</strong> &middot; Sessions and Authentication</p>
            <p>IT0049 Technical Formative Assessment 4</p>
        </div>
    </footer>
</body>
</html>

<?= $this->extend('templates/main') ?>

<?= $this->section('content') ?>
<section class="hero shell">
    <div class="hero-copy">
        <p class="eyebrow">Store operations, simplified</p>
        <h1>Secure access for everyday store work.</h1>
        <p class="lede">Northstar keeps customer and staff records behind a verified login using CodeIgniter sessions, password hashing, and route filters.</p>
        <div class="hero-actions">
            <?php if (session()->get('isLoggedIn')): ?>
                <a class="button button-primary" href="<?= site_url('customers') ?>">Browse customers</a>
                <a class="button button-secondary" href="<?= site_url('users') ?>">View user accounts</a>
            <?php else: ?>
                <a class="button button-primary" href="<?= site_url('login') ?>">Staff login</a>
                <a class="button button-secondary" href="<?= site_url('about') ?>">How access works</a>
            <?php endif; ?>
        </div>
    </div>
    <div class="hero-panel" aria-label="System overview">
        <div class="panel-heading"><span>Today at a glance</span><span class="status"><i></i> System ready</span></div>
        <div class="metric-grid">
            <article><span class="metric-icon">01</span><strong>6</strong><small>Customer accounts</small></article>
            <article><span class="metric-icon">02</span><strong>6</strong><small>Staff users</small></article>
            <article><span class="metric-icon">03</span><strong>1</strong><small>Protected workspace</small></article>
            <article><span class="metric-icon">04</span><strong>100%</strong><small>Hashed passwords</small></article>
        </div>
    </div>
</section>
<section class="section shell">
    <div class="section-heading">
        <div><p class="eyebrow">Authenticated workspace</p><h2>Only verified staff get access</h2></div>
        <p>This version preserves the database-backed forms from TFA3 and adds login, sessions, logout, and a reusable filter for every management route.</p>
    </div>
    <div class="feature-grid">
        <a class="feature-card" href="<?= site_url('customers') ?>"><span>Customers</span><h3>Keep contacts organized</h3><p>Review names, email addresses, and phone numbers in a clean account directory.</p><b>Open directory &rarr;</b></a>
        <a class="feature-card dark" href="<?= site_url('users') ?>"><span>Staff access</span><h3>Know who runs the store</h3><p>See usernames, full names, and assigned roles for every member of the team.</p><b>Open user accounts &rarr;</b></a>
        <a class="feature-card" href="<?= site_url('about') ?>"><span>Security</span><h3>Built with sessions and filters</h3><p>Learn how hashed passwords, session data, and pre-controller checks protect this CodeIgniter application.</p><b>Read about the app &rarr;</b></a>
    </div>
</section>
<?= $this->endSection() ?>

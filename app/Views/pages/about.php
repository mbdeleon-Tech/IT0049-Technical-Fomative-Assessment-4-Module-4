<?= $this->extend('templates/main') ?>

<?= $this->section('content') ?>
<section class="page-hero shell">
    <p class="eyebrow">About the project</p>
    <h1>Authentication before administration.</h1>
    <p>Northstar POS now verifies staff credentials and starts a server-side session before customer or user management pages can be opened.</p>
</section>
<section class="section shell about-grid">
    <div><p class="eyebrow">How it works</p><h2>A protected request flow</h2><p class="body-copy">The login controller verifies the submitted password against its stored hash. A successful login saves staff details in the session, while the authentication filter blocks protected requests that do not have that session state.</p></div>
    <ol class="process-list">
        <li><span>01</span><div><h3>Verify</h3><p><code>password_verify()</code> checks the submitted password without exposing the stored hash.</p></div></li>
        <li><span>02</span><div><h3>Remember</h3><p>CodeIgniter stores the authenticated user's ID, username, and name in the session.</p></div></li>
        <li><span>03</span><div><h3>Protect</h3><p>The authentication filter redirects logged-out visitors before a protected controller runs.</p></div></li>
    </ol>
</section>
<section class="section shell values-grid">
    <article><strong>Framework</strong><p>CodeIgniter 4</p></article>
    <article><strong>Authentication</strong><p>Sessions and hashed passwords</p></article>
    <article><strong>Access control</strong><p>CodeIgniter Filter</p></article>
    <article><strong>Data source</strong><p>MySQL database</p></article>
</section>
<?= $this->endSection() ?>

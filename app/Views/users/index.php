<?= $this->extend('templates/main') ?>

<?= $this->section('content') ?>
<section class="page-hero compact shell">
    <p class="eyebrow">Team directory</p>
    <div class="title-row"><div><h1>User Accounts</h1><p>Staff accounts with display-ready profile images.</p></div><a class="button button-primary" href="<?= site_url('users/new') ?>">New user</a></div>
</section>
<section class="table-section shell">
    <?php if (session('success')): ?><div class="notice success"><?= esc(session('success')) ?></div><?php endif; ?>
    <div class="table-wrap"><table>
        <thead><tr><th scope="col">User</th><th scope="col">Full name</th><th scope="col">Created</th><th scope="col">Action</th></tr></thead>
        <tbody>
        <?php foreach ($users as $user): ?>
            <tr>
                <td><img class="avatar-image" src="<?= base_url('uploads/' . ($user['avatar'] ?: 'placeholder.svg')) ?>" alt=""><code class="username"><?= esc($user['username']) ?></code></td>
                <td><strong><?= esc($user['full_name']) ?></strong></td>
                <td><span class="role-badge"><?= esc(date('M j, Y', strtotime($user['created_at']))) ?></span></td>
                <td><a class="text-link" href="<?= site_url('users/' . $user['id'] . '/edit') ?>">Edit</a></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table></div>
</section>
<?= $this->endSection() ?>

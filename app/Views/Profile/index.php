<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<section class="section">
    <div class="card">
        <div class="card-body pt-2">
        <h2 class="fw-bold display-6">Profil Pengguna</h2>
            <ul>
                <li><strong>Username:</strong> <?= esc($username) ?></li>
                <li><strong>Role:</strong> <?= esc($role) ?></li>
                <li><strong>Email:</strong> <?= esc($email) ?></li>
                <li><strong>Waktu Login:</strong> <?= esc($waktu_login) ?></li>
                <li><strong>Status:</strong> <?= esc($status) ?></li>
            </ul>
        </div>
    </div>
</section>
<?= $this->endSection() ?>

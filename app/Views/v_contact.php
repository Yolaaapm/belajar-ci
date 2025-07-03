<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<div class="container mt-4">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h4><?= esc($title) ?></h4>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <tr>
                    <th>Username</th>
                    <td><?= esc($username) ?></td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td><?= esc($email) ?></td>
                </tr>
                <tr>
                    <th>Role</th>
                    <td><?= esc($role) ?></td>
                </tr>
                <tr>
                    <th>Waktu Login</th>
                    <td><?= esc($waktu_login) ?></td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td>
                        <?php if ($status == 'Sudah Login') : ?>
                            <span class="badge bg-success"><?= esc($status) ?></span>
                        <?php else : ?>
                            <span class="badge bg-danger"><?= esc($status) ?></span>
                        <?php endif; ?>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

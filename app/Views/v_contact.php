<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<section class="section pt-2">
    <div class="card mt-2">
        <div class="card-body pt-4">

            <!-- Judul -->
            <h2 class="fw-bold text-center mb-4">Form Pengaduan</h2>

            <!-- Flash Message -->
            <?php if (session()->getFlashdata('success')) : ?>
                <div class="alert alert-success">
                    <?= session()->getFlashdata('success') ?>
                </div>
            <?php endif; ?>

            <!-- Form Pengaduan -->
            <form action="<?= base_url('contact') ?>" method="post" class="px-3">
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama</label>
                    <input type="text" class="form-control" name="nama" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" required>
                </div>
                <div class="mb-3">
                    <label for="pesan" class="form-label">Pesan</label>
                    <textarea name="pesan" class="form-control" rows="5" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Kirim</button>
            </form>

        </div>
    </div>
</section>

<?= $this->endSection() ?>

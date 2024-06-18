<?= $this->extend('layout/templateadmin'); ?>

<?= $this->section('contentadmin'); ?>

<div class="container">
    <div class="row">
        <div class="col-8">
            <h2 class="my-3">Form Ubah Data Kamar</h2>
            <!-- Validation Flash data ditampilin -->
            <?php if (session()->getFlashdata('validation')) : ?>
                <div class="alert alert-danger">
                    <?= session()->getFlashdata('validation'); ?>
                </div>
            <?php endif; ?>

            <form action="/admin/update/<?= $kamar['id']; ?>" method="post">
                <?= csrf_field(); ?> <!-- Agar form tidak diinput dari pihak ketiga -->

                <input type="hidden" name="slug" value="<?= $kamar['nama']; ?>">
                <div class="row mb-3">
                    <label for="Nama" class="col-sm-2 col-form-label">Nama Kamar</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control <?= (validation_show_error('Nama')) ? 'is-invalid' : ''; ?>" id="Nama" name="Nama" autofocus value="<?= (old('Nama')) ? old('Nama') : $kamar['nama']; ?>">
                        <div class="invalid-feedback">
                            <?= validation_show_error('Nama'); ?>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="Harga" class="col-sm-2 col-form-label">Harga</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control <?= (validation_show_error('Harga')) ? 'is-invalid' : ''; ?>" id="Harga" name="Harga" value="<?= (old('Harga')) ? old('Harga') : $kamar['harga']; ?>">
                        <div class="invalid-feedback">
                            <?= validation_show_error('Harga'); ?>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="Luas" class="col-sm-2 col-form-label">Luas</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control <?= (validation_show_error('Luas')) ? 'is-invalid' : ''; ?>" id="Luas" name="Luas" value="<?= (old('Luas')) ? old('Luas') : $kamar['luas']; ?>">
                        <div class="invalid-feedback">
                            <?= validation_show_error('Luas'); ?>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="Deskripsi" class="col-sm-2 col-form-label">Deskripsi</label>
                    <div class="col-sm-10">
                        <textarea class="form-control <?= (validation_show_error('Deskripsi')) ? 'is-invalid' : ''; ?>" id="Deskripsi" name="Deskripsi" rows="4"><?= (old('Deskripsi')) ? old('Deskripsi') : $kamar['deskripsi']; ?></textarea>
                        <div class="invalid-feedback">
                            <?= validation_show_error('Deskripsi'); ?>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="Gambar" class="col-sm-2 col-form-label">Gambar</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control <?= (validation_show_error('Gambar')) ? 'is-invalid' : ''; ?>" id="Gambar" name="Gambar" value="<?= (old('Gambar')) ? old('Gambar') : $kamar['gambar']; ?>">
                        <div class="invalid-feedback">
                            <?= validation_show_error('Gambar'); ?>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Ubah Data</button>
                <a href="/admin/daftarkamar" class="btn btn-outline-dark">Kembali ke daftar kamar</a>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>
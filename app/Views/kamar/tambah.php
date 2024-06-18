<?= $this->extend('layout/templateadmin'); ?>
<?= $this->section('contentadmin') ?>

<div class="container">
    <div class="row">
        <div class="col-8">
            <h2 class="my-3">Form Tambah Kamar</h2>
            <!--Validation Flash data ditampilin, pake cara kayak daftar komik -->

            <form action="<?= base_url('/admin/save'); ?>" method="post" enctype="multipart/form-data">

                <?= csrf_field(); ?> <!-- Agar form tidak diinput dari mpihak ketiga -->

                <div class="row mb-3">
                    <label for="Nama" class="col-sm-2 col-form-label">Nama Kamar</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control <?= validation_show_error('Nama') ? 'is-invalid' : ''; ?>" id="Nama" name="Nama" value="<?= old('Nama'); ?>" autofocus>
                        <div id="validationServer03Feedback" class="invalid-feedback">
                            <?= validation_show_error('Nama'); ?>
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="Harga" class="col-sm-2 col-form-label">Harga</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control <?= validation_show_error('Harga') ? 'is-invalid' : ''; ?>" id="Harga" name="Harga" value="<?= old('Harga'); ?>">
                        <div id="validationServer03Feedback" class="invalid-feedback">
                            <?= validation_show_error('Harga'); ?>
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="Luas" class="col-sm-2 col-form-label">Luas</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control <?= validation_show_error('Luas') ? 'is-invalid' : ''; ?>" id="Luas" name="Luas" value="<?= old('Luas'); ?>">
                        <div id="validationServer03Feedback" class="invalid-feedback">
                            <?= validation_show_error('Luas'); ?>
                        </div>
                        <p>Contoh: 4 x 5 meter</p>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="Deskripsi" class="col-sm-2 col-form-label">Deskripsi</label>
                    <div class="col-sm-10">
                        <textarea class="form-control <?= validation_show_error('Deskripsi') ? 'is-invalid' : ''; ?>" id="Deskripsi" name="Deskripsi" rows="6"><?= old('Deskripsi'); ?></textarea>
                        <div id="validationServer03Feedback" class="invalid-feedback">
                            <?= validation_show_error('Deskripsi'); ?>
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="Gambar" class="col-sm-2 col-form-label">Gambar</label>
                    <div class="col-sm-10">
                        <div class="mb-3">
                            <div class="custom-file">
                                <label for="gambar" class="form-label"></label>
                                <input class="form-control <?= validation_show_error('Gambar') ? 'is-invalid' : ''; ?>" type="file" id="Gambar" name="Gambar">
                                <div id="validationServer03Feedback" class="invalid-feedback">
                                    <?= validation_show_error('Gambar'); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-outline-secondary btn-gold">Tambah Data</button>

            </form>
        </div>
    </div>
</div>


<?= $this->endSection(); ?>
<?= $this->extend('layout/templateaut'); ?>

<?= $this->section('content'); ?>
<div class="container-auth">
    <div class="auth-form">
        <div class="row">
            <div class="col">
                <?= csrf_field(); ?>

                <!-- Registration Form -->
                <form id="register-form" action="/auth/register" method="POST">
                    <div style="display: flex; align-items: center; justify-content: center;">
                        <a href="<?= base_url('/'); ?>">
                            <img class="img-profile rounded-circle hover-zoom" src="/img/logo.png" style="max-width: 50px;">
                        </a>
                    </div>
                    <div class="form-tittle">
                        <h1 style="display: flex; align-items: center; justify-content: center;">Register</h1>
                    </div>

                    <?php if (session()->getFlashdata('pesansukses')) : ?>
                        <div class="alert alert-success" role="alert">
                            <?= session()->getFlashdata('pesansukses') ?>
                        </div>
                    <?php endif; ?>

                    <div class="form-group mt-3">
                        <label for="exampleInputEmail1">Username</label>
                        <input type="text" class="form-control <?= validation_show_error('Username') ? 'is-invalid' : ''; ?>" aria-describedby="emailHelp" placeholder="Masukkan Username" name="Username" value="<?= old('Username') ?>" autofocus class="form-control">
                        <?php if (validation_show_error('Username')) : ?>
                            <div class="invalid-feedback">
                                <?= validation_show_error('Username') ?>
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="form-group mt-3">
                        <label for="exampleInputEmail1">Email</label>
                        <input type="text" class="form-control <?= validation_show_error('Email') ? 'is-invalid' : ''; ?>" aria-describedby="EmailHelp" placeholder="Masukkan Email" name="Email" value="<?= old('Email') ?>" autofocus class="form-control">
                        <?php if (validation_show_error('Email')) : ?>
                            <div class="invalid-feedback">
                                <?= validation_show_error('Email') ?>
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="form-group mt-3">
                        <label for="exampleInputEmail1">Telepon</label>
                        <input type="text" class="form-control <?= validation_show_error('Telepon') ? 'is-invalid' : ''; ?>" aria-describedby="emailHelp" placeholder="Masukkan Nomor Telepon" name="Telepon" value="<?= old('Telepon') ?>" autofocus class="form-control">
                        <?php if (validation_show_error('Telepon')) : ?>
                            <div class="invalid-feedback">
                                <?= validation_show_error('Telepon') ?>
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="form-group mt-3">
                        <label for="exampleInputEmail1">Alamat</label>
                        <input type="text" class="form-control <?= validation_show_error('Alamat') ? 'is-invalid' : ''; ?>" aria-describedby="emailHelp" placeholder="Masukkan Alamat Rumah" name="Alamat" value="<?= old('Alamat') ?>" autofocus class="form-control">
                        <?php if (validation_show_error('Alamat')) : ?>
                            <div class="invalid-feedback">
                                <?= validation_show_error('Alamat') ?>
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="form-group mt-3">
                        <label for="exampleInputPassword1">Password</label>
                        <input type="password" class="form-control <?= validation_show_error('Password') ? 'is-invalid' : ''; ?>" placeholder="Masukkan Password" value="<?= old('Password') ?>" name="Password" class="form-control">
                        <?php if (validation_show_error('Password')) : ?>
                            <div class="invalid-feedback">
                                <?= validation_show_error('Password') ?>
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="text-center">
                        <input type="submit" name="login" class="btn btn-dark mt-4" value="Sign Up">
                        <p style="margin-top: 6px">Sudah punya akun? <a href="<?= base_url('auth/halamanlogin'); ?>">Login</a></p>
                    </div>
                </form>

                <?= $this->endSection(); ?>
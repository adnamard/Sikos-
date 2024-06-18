<?= $this->extend('layout/templateuser'); ?>

<?= $this->section('content'); ?>

<?php if (session()->getFlashdata('pesan')) : ?>
    <div class="alert alert-danger" role="alert">
        <?= session()->getFlashdata('pesan') ?>
    </div>
<?php endif; ?>


<?php if (session()->has('success')) : ?>
    <div class="alert alert-success">
        <?= session('success') ?>
    </div>
<?php endif ?>

<?php if (session()->has('error')) : ?>
    <div class="alert alert-danger">
        <?= session('error') ?>
    </div>
<?php endif ?>

<!-- Carousel -->
<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="/img/caraousel1.jpg" class="d-block w-100" alt="Slide 1">
        </div>
        <div class="carousel-item">
            <img src="/img/caraousel2.jpg" class="d-block w-100" alt="Slide 2">
        </div>
        <div class="carousel-item">
            <img src="/img/caraousel3.jpg" class="d-block w-100" alt="Slide 3">
        </div>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>

<!-- Typography Section -->
<section id="typography" class="text-center my-5">
    <div class="container">
        <h1 class="brand-name" id="logo">Sikos</h1>
        <p class="brand-description">Step into the world of Sikos, where each room tells a story of comfort and modernity. Embracing the essence of urban living, Sikos rooms are designed to be your sanctuary in the heart of the city. Imagine waking up to panoramic views and unwinding in spaces meticulously crafted for tranquility.</p>
    </div>
    <div>
        <lottie-player src="https://lottie.host/b67279a3-2c76-4835-a125-8f84712f3965/yZLSzmh9R2.json" background="#FFFFFF" speed="1" style="width: 300px; height: 300px;" loop controls autoplay direction="1" mode="normal">
        </lottie-player>
    </div>
</section>

<!-- Kamar Kos Section -->
<section id="kamar-kos" style="padding: 50px 0;">
    <div class="container">
        <h2 class="text-center mb-5">Kamar Kos</h2>
        <div class="row">
            <?php foreach ($kamar as $k) : ?>
                <div class="col-md-4">
                    <div class="card mb-4 shadow-sm border-0">
                        <img src="/img/<?= $k['gambar']; ?>" class="card-img-top" alt="<?= $k['nama']; ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?= $k['nama']; ?></h5>
                            <div class="d-flex justify-content-between">
                                <span><strong>Harga:</strong></span>
                                <span>Rp <?= number_format($k['harga'], 0, ',', '.'); ?></span>
                            </div>
                            <div class="d-flex justify-content-between">
                                <span><strong>Luas:</strong></span>
                                <span><?= $k['luas']; ?> m²</span>
                            </div>
                            <div class="mt-3">
                                <button type="button" class="btn btn-sm btn-outline-dark mr-1" data-toggle="modal" data-target="#viewModal<?= $k['id']; ?>">View</button>
                                <?php if (session()->has('userData')) : ?>
                                    <form action="<?= base_url('sewa/add/' . $k['id']); ?>" method="post" class="d-inline">
                                        <?= csrf_field(); ?>
                                        <button type="submit" class="btn btn-outline-successbtn-outline-secondary book-now">Book Now</button>
                                    </form>
                                <?php else : ?>
                                    <a href="#" class="btn btn-sm btn-outline-success book-now" data-toggle="modal" data-target="#loginModal">Book Now</a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal -->
                <div class="modal fade" id="viewModal<?= $k['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="viewModalLabel<?= $k['id']; ?>" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="viewModalLabel<?= $k['id']; ?>"><?= $k['nama']; ?></h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <img src="/img/<?= $k['gambar']; ?>" class="img-fluid mb-3" alt="<?= $k['nama']; ?>">
                                <div class="d-flex justify-content-between">
                                    <span><strong>Harga :</strong></span>
                                    <span>Rp <?= number_format($k['harga'], 0, ',', '.'); ?></span>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <span><strong>Luas:</strong></span>
                                    <span><?= $k['luas']; ?> m²</span>
                                </div>
                                <p class="mt-3"><?= $k['deskripsi']; ?></p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Login Modal -->
<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="loginModalLabel">Login Required</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Silakan log in terlebih dahulu untuk menyewa kamar ini</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
                <a href="autentikasi/halamanlogin" class="btn btn-outline-success">Login</a>
            </div>
        </div>
    </div>
</div>


<?= $this->endSection(); ?>
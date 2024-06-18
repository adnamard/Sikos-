<nav class="navbar navbar-expand-lg navbar-light">
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav mx-auto">
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('/'); ?>">
                    <img src="/img/logo.png" alt="Logo" style="max-width: 30px; height: auto;">
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('/'); ?>">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#kamar-kos">Kamar Kos</a>
            </li>
            <?php if (session()->has('userData')) : ?>
                <!-- If user is logged in -->
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('sewa/'); ?>">Keranjang</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('riwayat/'); ?>">Riwayat</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('auth/logout'); ?>">Logout</a>
                </li>
            <?php else : ?>
                <!-- If user is not logged in -->
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('auth/halamanlogin'); ?>">Masuk</a>
                </li>
            <?php endif; ?>
        </ul>
    </div>
</nav>
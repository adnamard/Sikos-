<?= $this->extend('layout/templateuser'); ?>

<?= $this->section('content'); ?>
<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-md-8">
            <?php if (session()->has('success')) : ?>
                <div class="alert alert-success">
                    <?= session('success') ?>
                </div>
            <?php elseif (session()->has('error')) : ?>
                <div class="alert alert-danger">
                    <?= session('error') ?>
                </div>
            <?php endif; ?>

            <h3 class="mb-4">Detail Transaksi</h3>

            <?php foreach ($sewa as $c) : ?>
                <div class="card mb-3">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img src="/img/<?= $c['gambar']; ?>" class="img-fluid" style="border-radius: 10px;" alt="<?= $c['nama']; ?>">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title">Nama Kamar: <?= $c['nama']; ?></h5>
                                <p class="card-text">Harga Kamar: Rp <?= number_format($c['harga'], 0, ',', '.'); ?></p>
                                <!-- Additional information -->
                                <form action="<?= base_url('sewa/delete/' . $c['id']); ?>" method="post" class="d-inline">
                                    <?= csrf_field(); ?>
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button type="submit" class="btn btn-outline-danger btn-sm" onclick="return confirm('Apakah anda yakin ingin menghapus?')">Hapus</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>

            <div class="card mb-3">
                <div class="row g-0">
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title">Total Harga: Rp <?= number_format($totalHarga, 0, ',', '.'); ?></h5>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Button to trigger payment confirmation modal -->
            <button class="btn btn-outline-dark d-block mx-auto" onclick="konfirmasiPembayaran()">
                Bayar
            </button>

            <!-- Confirmation Modal -->
            <div class="modal fade" id="confirmationModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Pembayaran</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            Yakin ingin melakukan pembayaran?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" onclick="pembayaranCekDulu()">Cek dulu</button>
                            <button type="button" class="btn btn-dark" onclick="pembayaranYa()">Ya</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Payment Info Modal -->
            <div class="modal fade" id="paymentInfoModal" tabindex="-1" role="dialog" aria-labelledby="paymentInfoModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="paymentInfoModalLabel">Informasi Pembayaran</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="/sewa/bayar" method="post" enctype="multipart/form-data" id="paymentForm">
                            <div class="modal-body">
                                <p>Silakan transfer ke rekening AN. <b>Gammarion 15210291 BCA</b></p>
                                <p>Jumlah yang harus dibayar: Rp <?= number_format($totalHarga, 0, ',', '.'); ?></p>
                                <div class="form-group mb-3">
                                    <label for="buktiPembayaran">Bukti Transfer (Jpg/Jpeg)</label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="fa fa-file"></i>
                                        </span>
                                        <input type="file" class="form-control-file" id="buktiPembayaran" name="buktiPembayaran" required>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-outline-dark" onclick="pembayaranCekDulu()">Tutup</button>
                                <button type="submit" class="btn btn-outline-dark">Kirim</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function konfirmasiPembayaran() {
        $('#confirmationModal').modal('show');
    }

    function pembayaranCekDulu() {
        window.location.href = "<?php echo base_url('sewa/'); ?>";
    }

    function pembayaranYa() {
        $('#confirmationModal').modal('hide');
        $('#paymentInfoModal').modal('show');
    }
</script>

<?= $this->endSection(); ?>
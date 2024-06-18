<?= $this->extend('layout/templateuser'); ?>

<?= $this->section('content'); ?>
<?php if (session()->has('success')) : ?>
    <div class="alert alert-success">
        <?= session('success') ?>
    </div>
<?php elseif (session()->has('error')) : ?>
    <div class="alert alert-danger">
        <?= session('error') ?>
    </div>
<?php endif; ?>
<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-md-8">
            <h3 class="mb-4 text-center">Riwayat Pembelian</h3>

            <?php
            // Array untuk data bayar_keberapa sebagai kunci
            $dataPerBayarKeberapa = [];

            // Mengelompokkan data berdasarkan bayar_keberapa
            foreach ($riwayatTransaksi as $item) {
                $transaksi = $item['transaksi'];
                $dataPerBayarKeberapa[$transaksi][] = $item;
            }
            ?>

            <?php foreach ($dataPerBayarKeberapa as $transaksi => $items) : ?>
                <?php foreach ($items as $item) : ?>
                    <div class="card mb-3">
                        <div class="card-body">
                            <h5 class="card-title">Transaksi-<?= $transaksi ?></h5>
                            <div class="row g-0">
                                <div class="col-md-4">
                                    <img src="/img/<?= $item['bukti_pembayaran']; ?>" class="img-fluid rounded" style="max-width: 200px;" alt="Bukti Pembayaran">
                                </div>
                                <div class="col-md-8">
                                    <p class="card-text">Nama: <?= $item['username']; ?></p>
                                    <p class="card-text">Email: <?= $item['email']; ?></p>
                                    <div class="mb-2">
                                        <p class="card-text"><strong>Status:</strong>
                                            <span class="<?= getStatusColorClass($item['status_id']); ?> p-1 rounded"><?= $item['status']; ?></span>
                                        </p>
                                    </div>
                                    <button type="button" class="btn btn-outline-dark" style="position: absolute; bottom: 15px; right: 25px; border-radius: 75px;" onclick="detailtransaksi(<?= $item['id'] ?>)">Detail</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal for Transaction Detail -->
                    <div class="modal fade" id="detailtransaksi<?= $item['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="detailtransaksi<?= $item['id'] ?>Label" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="detailtransaksi<?= $item['id'] ?>Label">Detail Transaksi</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col">
                                            <p>ID: <?= $item['id']; ?></p>
                                            <p>Username: <?= $item['username']; ?></p>
                                            <p>Email: <?= $item['email']; ?></p>
                                            <p>Transaksi ke-<?= $item['transaksi']; ?></p>
                                            <hr>
                                            <p>Kamar yang Disewa:</p>
                                            <p>Nama Kamar: <?= $item['nama']; ?></p>
                                            <p>Luas Kamar: <?= $item['luas']; ?></p>
                                            <p>Harga Kamar: <?= $item['harga']; ?></p>
                                            <p>Jumlah: <?= $item['jumlah']; ?></p>
                                            <p>Status: <?= $item['status']; ?></p>
                                            <p>Tanggal Pembelian: <?= $item['tanggal_pembelian']; ?></p>
                                            <hr>
                                            <p>Bukti Pembayaran:</p>
                                            <img src="/img/<?= $item['bukti_pembayaran']; ?>" class="img-fluid" alt="Bukti Pembayaran">
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-outline-dark" onclick="tutupdetail()">Tutup</button>
                                </div>
                            </div>
                        </div>
                    </div>

                <?php endforeach; ?>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<script>
    function detailtransaksi(transactionId) {
        $('#detailtransaksi' + transactionId).modal('show');
    }

    function tutupdetail() {
        window.location.href = "<?php echo base_url('riwayat/'); ?>";
    }
</script>
<?php
function getStatusColorClass($status)
{
    switch ($status) {
        case 1:
            return 'bg-warning'; // Warna kuning
        case 2:
            return 'bg-success'; // Warna hijau
        case 3:
            return 'bg-danger'; // Warna merah
        default:
            return ''; // Warna default
    }
}
?>
<?= $this->endSection(); ?>
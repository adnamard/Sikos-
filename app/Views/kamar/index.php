<?= $this->extend('layout/templateadmin'); ?>

<?= $this->section('contentadmin'); ?>

<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Daftar Kamar</h1>

    <!-- User List Table -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-dark">Daftar Kamar</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                    <thead class="thead-dark">
                        <tr>
                            <th>Nama</th>
                            <th>Harga</th>
                            <th>Lain-lain</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($daftarkamar as $kamar) : ?>
                            <tr>
                                <td><?= esc($kamar['nama']); ?></td>
                                <td><?= esc($kamar['harga']); ?></td>
                                <td>
                                    <a href="/admin/<?= $kamar['nama']; ?>" class="btn btn-outline-secondary">Detail</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>
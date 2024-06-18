<?= $this->extend('layout/templateadmin'); ?>

<?= $this->section('contentadmin'); ?>

<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Daftar Pengguna</h1>

    <!-- User List Table -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-dark">User List</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                    <thead class="thead-dark">
                        <tr>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Alamat</th>
                            <th>Telepon</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($daftaruser as $user) : ?>
                            <tr>
                                <td><?= esc($user['username']); ?></td>
                                <td><?= esc($user['email']); ?></td>
                                <td><?= esc($user['alamat']); ?></td>
                                <td><?= esc($user['telepon']); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>
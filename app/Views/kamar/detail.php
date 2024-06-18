<?= $this->extend('layout/templateadmin'); ?>

<?= $this->section('contentadmin'); ?>
<div class="container mt-4">
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h1 class="h3 mb-0 text-gray-800"><?= esc($kamar['nama']); ?></h1>
            <div>
                <a href="<?= base_url('/admin/edit/' . $kamar['nama']); ?>" class="btn btn-warning btn-sm">
                    <i class="fas fa-edit"></i> Edit
                </a>
                <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal">
                    <i class="fas fa-trash-alt"></i> Delete
                </button>
                <a href="<?= base_url('admin/daftarkamar'); ?>" class="btn btn-success btn-sm">
                    <i class="fas fa-edit"></i> Kembali
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-6">
                    <img src="<?= base_url('/img/' . $kamar['gambar']); ?>" class="img-fluid rounded mb-4" alt="<?= esc($kamar['nama']); ?>">
                </div>
                <div class="col-lg-6">
                    <h5 class="card-title">Luas: <?= esc($kamar['luas']); ?> m²</h5>
                    <h5 class="card-title">Harga: Rp <?= number_format($kamar['harga'], 0, ',', '.'); ?></h5>
                    <p class="card-text">Deskripsi: <?= esc($kamar['deskripsi']); ?></p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Anda yakin ingin menghapus?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Anda yakin ingin menghapus data kamar ini?
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <form action="/admin/delete/<?= $kamar['id']; ?>" method="post" class="d-inline">
                    <?= csrf_field(); ?>
                    <input type="hidden" name="_method" value="DELETE">
                    <button type="submit" class="btn btn-outline-danger" onclick="return confirm('Apakah anda yakin ingin menghapus?')">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>
<?= $this->extend('layouts/admin') ?>

<?= $this->section('title') ?>
Template Sertifikat
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between align-items-center w-100">
            <h3 class="card-title mb-0">
                <i class="fas fa-file-alt mr-2 text-secondary"></i> Data Template Sertifikat
            </h3>
            <button type="button" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#modalTambah">
                <i class="fas fa-plus"></i> Tambah Template
            </button>
        </div>
    </div>
    <div class="card-body">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Template</th>
                    <th>Gambar</th>
                    <th>Dibuat Pada</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1;
                foreach ($templates as $t): ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= esc($t['nama_template']) ?></td>
                        <td>
                            <img src="<?= base_url('uploads/templates/' . $t['gambar']) ?>" alt="Gambar" style="height:50px;">
                        </td>
                        <td><?= date('d-m-Y H:i', strtotime($t['created_at'])) ?></td>
                        <td>
                            <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modalEdit<?= $t['id'] ?>">
                                <i class="fas fa-edit"></i>
                            </button>
                            <a href="<?= base_url('admin/template/delete/' . $t['id']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus template ini?');">
                                <i class="fas fa-trash"></i>
                            </a>
                        </td>
                    </tr>

                    <!-- Modal Edit -->
                    <div class="modal fade" id="modalEdit<?= $t['id'] ?>" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog">
                            <form action="<?= base_url('admin/template/update/' . $t['id']) ?>" method="post" enctype="multipart/form-data">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Edit Template</h5>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label>Nama Template</label>
                                            <input type="text" name="nama_template" class="form-control" value="<?= esc($t['nama_template']) ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Ganti Gambar (Opsional)</label>
                                            <input type="file" name="gambar" class="form-control" accept="image/*">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<div class="modal fade" id="modalTambah" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <form action="<?= base_url('admin/template/store') ?>" method="post" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Template</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama Template</label>
                        <input type="text" name="nama_template" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Gambar Template</label>
                        <input type="file" name="gambar" class="form-control" accept="image/*" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>

<?= $this->endSection() ?>
<?= $this->extend('layouts/superadmin') ?>

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
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?= $this->endSection() ?>
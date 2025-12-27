<?= $this->extend('layouts/superadmin') ?>

<?= $this->section('title') ?>
Sertifikat Peserta
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between align-items-center w-100">
            <h3 class="card-title mb-0">
                <i class="fas fa-certificate mr-2 text-secondary"></i> Data Sertifikat Peserta
            </h3>
        </div>
    </div>
    <div class="card-body">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Peserta</th>
                    <th>Event</th>
                    <th>Nomor Sertifikat</th>
                    <th>Tanggal Terbit</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($sertifikats)): ?>
                    <?php $no = 1;
                    foreach ($sertifikats as $s): ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= esc($s['nama_peserta']) ?></td>
                            <td><?= esc($s['nama_event']) ?></td>
                            <td><?= esc($s['nomor_sertifikat']) ?></td>
                            <td><?= date('d-m-Y', strtotime($s['dibuat_pada'])) ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7" class="text-center">Belum ada sertifikat</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?= $this->endSection() ?>
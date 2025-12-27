<?= $this->extend('layouts/pengguna') ?>

<?= $this->section('title') ?>Daftar Peserta<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="container py-4">
    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header">
                    <h3 class="card-title mb-0">Daftar Peserta</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead class="text-center">
                                <tr>
                                    <th>No</th>
                                    <th>Nama Lengkap</th>
                                    <th>Nama Event</th>
                                    <th>Kategori</th>
                                    <th>Event Dimulai</th>
                                    <th>Kewarganegaraan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($peserta)): ?>
                                    <?php $no = 1; ?>
                                    <?php foreach ($peserta as $p): ?>
                                        <tr>
                                            <td class="text-center"><?= $no++ ?></td>
                                            <td><?= esc($p['nama_lengkap']) ?></td>
                                            <td><?= esc($p['nama_event']) ?></td>
                                            <td><?= esc($p['nama_kategori']) ?></td>
                                            <td class="text-center"><?= date('d-m-Y', strtotime($p['tanggal_event'])) ?></td>
                                            <td><?= esc($p['kewarganegaraan']) ?></td>
                                            <td class="text-center">
                                                <?php if (!empty($p['sertifikat_id'])): ?>
                                                    <a href="<?= site_url('pengguna/daftarpeserta/preview/' . $p['sertifikat_id']) ?>"
                                                        class="btn btn-sm btn-primary">
                                                        <i class="fas fa-file-alt"></i> Sertifikat
                                                    </a>
                                                <?php else: ?>
                                                    <span class="badge bg-secondary">Belum Ada Sertifikat</span>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    <?php endforeach ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="8" class="text-center">Belum ada data peserta.</td>
                                    </tr>
                                <?php endif ?>
                            </tbody>
                            <tfoot class="text-center">
                                <tr>
                                    <th>No</th>
                                    <th>Nama Lengkap</th>
                                    <th>Nama Event</th>
                                    <th>Kategori</th>
                                    <th>Event Dimulai</th>
                                    <th>Kewarganegaraan</th>
                                    <th>Aksi</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
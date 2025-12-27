<?= $this->extend('layouts/admin') ?>

<?= $this->section('title') ?>
Daftar Peserta
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="card">
    <div class="card-header">
        <h3 class="card-title">Daftar Peserta</h3>
    </div>
    <div class="card-body">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Peserta</th>
                    <th>Nama Event</th>
                    <th>Kategori Event</th>
                    <th>Status Pembayaran</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($pendaftar)): ?>
                    <?php $no = 1;
                    foreach ($pendaftar as $p): ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= esc($p['nama_lengkap']) ?></td>
                            <td><?= esc($p['nama_event']) ?></td>
                            <td><?= esc($p['nama_kategori']) ?></td>
                            <td>
                                <?php if ($p['status_pembayaran'] == 'lunas'): ?>
                                    <span class="badge bg-success">Lunas</span>
                                <?php elseif ($p['status_pembayaran'] == 'gagal'): ?>
                                    <span class="badge bg-danger">Gagal</span>
                                <?php else: ?>
                                    <span class="badge bg-warning text-dark">Pending</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <a href="<?= site_url('admin/pendaftar/detail/' . $p['id']) ?>"
                                    class="btn btn-sm btn-info">
                                    <i class="fas fa-eye"></i> Detail
                                </a>
                                <?php if ($p['status_pembayaran'] == 'lunas'): ?>
                                    <?php if (!empty($p['email_terkirim']) && $p['email_terkirim'] == 1): ?>
                                        <span class="badge bg-primary">Email Sudah Dikirim</span>
                                    <?php else: ?>
                                        <a href="<?= site_url('admin/pendaftar/kirimEmail/' . $p['id']) ?>"
                                            class="btn btn-sm btn-success">
                                            <i class="fas fa-envelope"></i> Kirim Email
                                        </a>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </td>

                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" class="text-center">Belum ada peserta yang terdaftar.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
            <tfoot>
                <tr>
                    <th>No</th>
                    <th>Nama Peserta</th>
                    <th>Nama Event</th>
                    <th>Kategori Event</th>
                    <th>Status Pembayaran</th>
                    <th>Aksi</th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>


<?= $this->endSection() ?>
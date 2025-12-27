<?= $this->extend('layouts/admin') ?>

<?= $this->section('title') ?>
Detail Peserta
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h3 class="card-title">Detail Peserta</h3>
        <a href="<?= site_url('admin/pendaftar') ?>" class="btn btn-secondary btn-sm">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>

    <div class="card-body">
        <?php if (!empty($pendaftar)): ?>
            <div class="row">
                <div class="col-md-6">
                    <h5><strong>Data Peserta</strong></h5>
                    <table class="table table-sm table-striped">
                        <tr>
                            <th>Nama Lengkap</th>
                            <td><?= esc($pendaftar['nama_lengkap']) ?></td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td><?= esc($pendaftar['email']) ?></td>
                        </tr>
                        <tr>
                            <th>No Telepon</th>
                            <td><?= esc($pendaftar['no_tlp']) ?></td>
                        </tr>
                        <tr>
                            <th>Alamat</th>
                            <td><?= esc($pendaftar['alamat_lengkap']) ?></td>
                        </tr>
                        <tr>
                            <th>Jenis Kelamin</th>
                            <td><?= esc($pendaftar['jenis_kelamin']) ?></td>
                        </tr>
                        <tr>
                            <th>Tanggal Lahir</th>
                            <td><?= esc($pendaftar['tanggal_lahir']) ?></td>
                        </tr>
                        <tr>
                            <th>No Identitas</th>
                            <td><?= esc($pendaftar['no_identitas']) ?></td>
                        </tr>
                        <tr>
                            <th>Ukuran Kaos</th>
                            <td><?= esc($pendaftar['ukuran_kaos']) ?></td>
                        </tr>
                    </table>
                </div>

                <div class="col-md-6">
                    <h5><strong>Data Event</strong></h5>
                    <table class="table table-sm table-striped">
                        <tr>
                            <th>Nama Event</th>
                            <td><?= esc($pendaftar['nama_event']) ?></td>
                        </tr>
                        <tr>
                            <th>Kategori Event</th>
                            <td><?= esc($pendaftar['nama_kategori']) ?></td>
                        </tr>
                        <tr>
                            <th>Rute</th>
                            <td><?= esc($pendaftar['rute']) ?></td>
                        </tr>
                        <tr>
                            <th>Biaya</th>
                            <td>Rp <?= number_format($pendaftar['biaya'], 0, ',', '.') ?></td>
                        </tr>
                        <tr>
                            <th>Jumlah Pembayaran</th>
                            <td>Rp <?= number_format($pendaftar['jumlah_pembayaran'], 0, ',', '.') ?></td>
                        </tr>
                        <tr>
                            <th>Status Pembayaran</th>
                            <td>
                                <?php if ($pendaftar['status_pembayaran'] == 'lunas'): ?>
                                    <span class="badge bg-success">Lunas</span>
                                <?php elseif ($pendaftar['status_pembayaran'] == 'gagal'): ?>
                                    <span class="badge bg-danger">Gagal</span>
                                <?php else: ?>
                                    <span class="badge bg-warning text-dark">Pending</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <tr>
                            <th>Bukti Pembayaran</th>
                            <td>
                                <?php if (!empty($pendaftar['bukti_pembayaran'])): ?>
                                    <a href="<?= base_url('uploads/bukti_pembayaran/' . $pendaftar['bukti_pembayaran']) ?>" target="_blank">
                                        <img src="<?= base_url('uploads/bukti_pembayaran/' . $pendaftar['bukti_pembayaran']) ?>" width="120" class="img-thumbnail">
                                    </a>
                                <?php else: ?>
                                    <em>Belum ada</em>
                                <?php endif; ?>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>

            <hr>

            <?php if ($pendaftar['status_pembayaran'] != 'lunas'): ?>
                <form action="<?= site_url('admin/pendaftar/ubahStatus/' . $pendaftar['id']) ?>" method="post">
                    <?= csrf_field() ?>
                    <div class="row">
                        <div class="col-md-4">
                            <label for="status_pembayaran" class="form-label">Ubah Status Pembayaran</label>
                            <select name="status_pembayaran" id="status_pembayaran" class="form-control" required>
                                <option value="">--Pilih Status--</option>
                                <option value="pending" <?= $pendaftar['status_pembayaran'] == 'pending' ? 'selected' : '' ?>>Pending</option>
                                <option value="lunas" <?= $pendaftar['status_pembayaran'] == 'lunas' ? 'selected' : '' ?>>Lunas</option>
                                <option value="gagal" <?= $pendaftar['status_pembayaran'] == 'gagal' ? 'selected' : '' ?>>Gagal</option>
                            </select>
                        </div>
                        <div class="col-md-2 d-flex align-items-end">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Simpan
                            </button>
                        </div>
                    </div>
                </form>
            <?php else: ?>
                <div class="alert alert-success">
                    <strong>Status Pembayaran:</strong> Lunas. Tidak bisa diubah lagi.
                </div>
            <?php endif; ?>


        <?php else: ?>
            <div class="alert alert-warning">Data peserta tidak ditemukan.</div>
        <?php endif; ?>
    </div>
</div>

<?= $this->endSection() ?>
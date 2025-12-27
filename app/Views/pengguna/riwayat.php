<?= $this->extend('layouts/pengguna') ?>

<?= $this->section('title') ?>Riwayat Pendaftaran<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="container py-4">
    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header">
                    <h3 class="card-title mb-0">Riwayat Pendaftaran</h3>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example1" class="table table-bordered table-striped text-center align-middle">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Event</th>
                                    <th>Tanggal Event</th>
                                    <th>Lokasi</th>
                                    <th>Google Maps</th>
                                    <th>Kategori</th>
                                    <th>Status Pembayaran</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($riwayat)): ?>
                                    <?php $no = 1;
                                    foreach ($riwayat as $row): ?>
                                        <?php
                                        // Membuat alamat lengkap dari kelurahan, kecamatan, kabupaten, provinsi
                                        $alamatParts = array_filter([
                                            $row['kelurahan'] ?? '',
                                            $row['kecamatan'] ?? '',
                                            $row['kabupaten'] ?? '',
                                            $row['provinsi'] ?? ''
                                        ]);
                                        $alamatLengkap = implode(', ', $alamatParts);
                                        
                                        // Cek apakah link Google Maps valid
                                        $hasValidLink = !empty($row['link_gmaps']) && filter_var($row['link_gmaps'], FILTER_VALIDATE_URL);
                                        ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= esc($row['nama_event']) ?></td>
                                            <td><?= date('d-m-Y', strtotime($row['tanggal_event'])) ?></td>
                                            <td class="text-start">
                                                <?php if (!empty($alamatLengkap)): ?>
                                                    <?= esc($alamatLengkap) ?>
                                                <?php else: ?>
                                                    <span class="text-muted">-</span>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <?php if ($hasValidLink): ?>
                                                    <a href="<?= esc($row['link_gmaps']) ?>" 
                                                       target="_blank" 
                                                       class="btn btn-sm btn-outline-primary"
                                                       title="Buka di Google Maps">
                                                        <i class="fas fa-map-marker-alt me-1"></i> Maps
                                                    </a>
                                                <?php else: ?>
                                                    <span class="text-muted">-</span>
                                                <?php endif; ?>
                                            </td>
                                            <td><?= esc($row['kategori']) ?></td>
                                            <td>
                                                <?php if ($row['status_pembayaran'] === 'pending'): ?>
                                                    <span class="badge bg-warning text-dark">Pending</span>
                                                <?php elseif ($row['status_pembayaran'] === 'lunas'): ?>
                                                    <span class="badge bg-success">Lunas</span>
                                                <?php else: ?>
                                                    <span class="badge bg-secondary"><?= esc($row['status_pembayaran']) ?></span>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <a href="<?= base_url('pengguna/riwayat/detail/' . $row['id']) ?>"
                                                    class="btn btn-sm btn-primary">
                                                    <i class="fas fa-eye"></i> Detail
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="8">Belum ada riwayat pendaftaran.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Event</th>
                                    <th>Tanggal Event</th>
                                    <th>Lokasi</th>
                                    <th>Google Maps</th>
                                    <th>Kategori</th>
                                    <th>Status Pembayaran</th>
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
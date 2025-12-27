<?= $this->extend('layouts/admin') ?>

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
            <button type="button" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#modalTambah">
                <i class="fas fa-plus"></i> Tambah Sertifikat
            </button>
        </div>
    </div>
    <div class="card-body">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Peserta</th>
                    <th>Event</th>
                    <th>Template</th>
                    <th>Nomor Sertifikat</th>
                    <th>Tanggal Terbit</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($sertifikat)): ?>
                    <?php $no = 1;
                    foreach ($sertifikat as $s): ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= esc($s['nama_peserta']) ?></td>
                            <td><?= esc($s['nama_event']) ?></td>
                            <td><?= esc($s['nama_template']) ?></td>
                            <td>
                                <span class="badge badge-primary">
                                    <?= esc($s['nomor_sertifikat']) ?>
                                </span>
                            </td>
                            <td>
                                <?php
                                $tanggal = strtotime($s['dibuat_pada']);
                                $bulan = [
                                    'January' => 'Januari',
                                    'February' => 'Februari',
                                    'March' => 'Maret',
                                    'April' => 'April',
                                    'May' => 'Mei',
                                    'June' => 'Juni',
                                    'July' => 'Juli',
                                    'August' => 'Agustus',
                                    'September' => 'September',
                                    'October' => 'Oktober',
                                    'November' => 'November',
                                    'December' => 'Desember'
                                ];
                                echo date('d', $tanggal) . ' ' . $bulan[date('F', $tanggal)] . ' ' . date('Y', $tanggal);
                                ?>
                            </td>
                            <td>
                                <a href="<?= base_url('admin/sertifikat/preview/' . $s['id']) ?>"
                                    class="btn btn-success btn-sm" target="_blank">
                                    <i class="fas fa-eye"></i> Preview
                                </a>
                                <a href="<?= base_url('admin/sertifikat/delete/' . $s['id']) ?>"
                                    class="btn btn-danger btn-sm"
                                    onclick="return confirm('Yakin ingin menghapus sertifikat ini?');">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>
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

<div class="modal fade" id="modalTambah" tabindex="-1" aria-labelledby="modalTambahLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="<?= site_url('admin/sertifikat/store') ?>" method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTambahLabel">Tambah Sertifikat</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle"></i> Nomor sertifikat akan dibuat otomatis (P00001 - P99999)
                    </div>
                    
                    <div class="form-group">
                        <label for="pendaftar_id">Peserta</label>
                        <select class="form-control" name="pendaftar_id" id="pendaftar_id" required>
                            <option value="">-- Pilih Peserta --</option>
                            <?php foreach ($pendaftar as $p): ?>
                                <option value="<?= $p['id'] ?>">
                                    <?= esc($p['nama_lengkap']) ?> - <?= esc($p['nama_event']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <small class="form-text text-muted">Peserta yang sudah memiliki sertifikat tidak dapat dipilih lagi</small>
                    </div>

                    <div class="form-group">
                        <label for="template_id">Template</label>
                        <select class="form-control" name="template_id" id="template_id" required>
                            <option value="">-- Pilih Template --</option>
                            <?php foreach ($templates as $t): ?>
                                <option value="<?= $t['id'] ?>"><?= esc($t['nama_template']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label>Nomor Sertifikat (Otomatis)</label>
                        <div class="alert alert-warning">
                            <i class="fas fa-key"></i> Sistem akan membuat nomor otomatis
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Buat Sertifikat</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Filter peserta yang sudah memiliki sertifikat
        const pendaftarSelect = document.getElementById('pendaftar_id');
        const pesertaDenganSertifikat = <?= json_encode(array_column($sertifikat ?? [], 'pendaftaran_id')) ?>;
        
        // Nonaktifkan opsi peserta yang sudah memiliki sertifikat
        if (pendaftarSelect) {
            for (let option of pendaftarSelect.options) {
                if (option.value && pesertaDenganSertifikat.includes(parseInt(option.value))) {
                    option.disabled = true;
                    option.textContent += ' (Sudah memiliki sertifikat)';
                }
            }
        }
        
        // Validasi sebelum submit
        const form = document.querySelector('form');
        if (form) {
            form.addEventListener('submit', function(e) {
                const pendaftarId = document.getElementById('pendaftar_id').value;
                const templateId = document.getElementById('template_id').value;
                
                if (!pendaftarId || !templateId) {
                    e.preventDefault();
                    alert('Harap pilih peserta dan template terlebih dahulu!');
                }
            });
        }
    });
</script>

<?= $this->endSection() ?>
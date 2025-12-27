<?= $this->extend('layouts/pengguna') ?>

<?= $this->section('title') ?>Detail Pendaftaran<?= $this->endSection() ?>

<?= $this->section('styles') ?>
<style>
    .page-title {
        font-weight: 600;
        text-align: center;
        margin-bottom: 25px;
    }

    .ticket-card {
        border: 2px dashed #6AA8A2;
        border-radius: 15px;
        padding: 20px;
        background: #fff;
        margin-bottom: 25px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
    }

    .ticket-header {
        background-color: #6AA8A2;
        color: #fff;
        padding: 10px 15px;
        border-radius: 10px 10px 0 0;
        font-weight: 600;
        font-size: 1.1rem;
        margin-bottom: 15px;
        text-align: center;
    }

    .detail-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 1rem;
    }

    .detail-grid .item {
        display: flex;
        flex-direction: column;
        padding: 8px 10px;
        border-radius: 8px;
        background-color: #f9f9f9;
    }

    .detail-grid .label {
        font-weight: 600;
        font-size: 0.9rem;
        color: #555;
        margin-bottom: 4px;
    }

    .detail-grid .value {
        font-size: 1rem;
        color: #333;
    }

    .badge {
        padding: 6px 12px;
        border-radius: 5px;
        font-size: 0.85rem;
    }

    .btn-secondary {
        background-color: #6AA8A2;
        border: none;
    }

    .btn-secondary:hover {
        background-color: #5a8d87;
    }

    .bukti-pembayaran img {
        max-width: 100%;
        height: auto;
        border-radius: 10px;
        border: 2px solid #6AA8A2;
    }
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="container py-5">
    <h3 class="page-title">Detail Pendaftaran</h3>

    <div class="col-lg-10 mx-auto">
        <div class="ticket-card">
            <div class="ticket-header">Informasi Event</div>
            <div class="detail-grid">
                <div class="item">
                    <span class="label">Nama Event</span>
                    <span class="value"><?= esc($pendaftaran['nama_event']) ?></span>
                </div>
                <div class="item">
                    <span class="label">Kategori Event</span>
                    <span class="value"><?= esc($pendaftaran['nama_kategori']) ?></span>
                </div>
                <div class="item">
                    <span class="label">Rute</span>
                    <span class="value"><?= esc($pendaftaran['rute']) ?></span>
                </div>
                <div class="item">
                    <span class="label">Biaya</span>
                    <span class="value">Rp <?= number_format($pendaftaran['biaya'], 0, ',', '.') ?></span>
                </div>
                <div class="item">
                    <span class="label">Status Pembayaran</span>
                    <span class="value">
                        <?php if ($pendaftaran['status_pembayaran'] === 'pending'): ?>
                            <span class="badge bg-warning text-dark">Pending</span>
                        <?php elseif ($pendaftaran['status_pembayaran'] === 'lunas'): ?>
                            <span class="badge bg-success">Lunas</span>
                        <?php else: ?>
                            <span class="badge bg-secondary"><?= esc($pendaftaran['status_pembayaran']) ?></span>
                        <?php endif; ?>
                    </span>
                </div>
            </div>
        </div>
        <div class="ticket-card">
            <div class="ticket-header">Data Peserta</div>
            <div class="detail-grid">
                <div class="item"><span class="label">Nama Lengkap</span><span class="value"><?= esc($pendaftaran['nama_lengkap']) ?></span></div>
                <div class="item"><span class="label">Email</span><span class="value"><?= esc($pendaftaran['email']) ?></span></div>
                <div class="item"><span class="label">No. Telepon</span><span class="value"><?= esc($pendaftaran['no_tlp']) ?></span></div>
                <div class="item"><span class="label">Alamat Lengkap</span><span class="value"><?= esc($pendaftaran['alamat_lengkap']) ?></span></div>
                <div class="item"><span class="label">Provinsi / Kabupaten</span><span class="value"><?= esc($pendaftaran['provinsi']) ?> / <?= esc($pendaftaran['kabupaten']) ?></span></div>
                <div class="item"><span class="label">Kewarganegaraan</span><span class="value"><?= esc($pendaftaran['kewarganegaraan']) ?></span></div>
                <div class="item"><span class="label">No. Identitas</span><span class="value"><?= esc($pendaftaran['no_identitas']) ?></span></div>
                <div class="item"><span class="label">Golongan Darah</span><span class="value"><?= esc($pendaftaran['goldar']) ?></span></div>
                <div class="item"><span class="label">Jenis Kelamin</span><span class="value"><?= esc($pendaftaran['jenis_kelamin']) ?></span></div>
                <div class="item"><span class="label">Tanggal Lahir</span><span class="value"><?= esc($pendaftaran['tanggal_lahir']) ?></span></div>
                <div class="item"><span class="label">Riwayat Penyakit</span><span class="value"><?= esc($pendaftaran['riwayat_penyakit']) ?></span></div>
                <div class="item"><span class="label">Kontak Darurat</span>
                    <span class="value"><?= esc($pendaftaran['nama_kontak_darurat']) ?> (<?= esc($pendaftaran['hubungan_kontak_darurat']) ?>) - <?= esc($pendaftaran['nohp_kontak_darurat']) ?></span>
                </div>
                <div class="item"><span class="label">Ukuran Kaos</span><span class="value"><?= esc($pendaftaran['ukuran_kaos']) ?></span></div>
            </div>
        </div>
        <?php if (!empty($pendaftaran['bukti_pembayaran'])): ?>
            <div class="ticket-card">
                <div class="ticket-header">Bukti Pembayaran</div>
                <div class="text-center bukti-pembayaran">
                    <img src="<?= base_url('uploads/bukti_pembayaran/' . $pendaftaran['bukti_pembayaran']) ?>" alt="Bukti Pembayaran">
                </div>
            </div>
        <?php endif; ?>

        <div class="text-end">
            <a href="<?= base_url('pengguna/riwayat') ?>" class="btn btn-secondary mt-3">Kembali</a>
        </div>

    </div>
</div>

<?= $this->endSection() ?>
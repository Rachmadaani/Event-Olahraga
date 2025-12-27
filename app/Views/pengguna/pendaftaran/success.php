<?= $this->extend('layouts/pengguna') ?>

<?= $this->section('title') ?>
Pendaftaran - Sukses
<?= $this->endSection() ?>

<?= $this->section('styles') ?>
<style>
    body {
        background: url('<?= base_url('img/carousel/4.png') ?>') no-repeat center center fixed;
        background-size: cover;
    }

    .overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.6);
        z-index: -1;
    }

    .form-container {
        background-color: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        border-radius: 15px;
        padding: 40px;
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
        color: #fff;
    }

    h2,
    h5 {
        color: #fff;
    }

    .list-group-item {
        background-color: rgba(255, 255, 255, 0.15);
        color: #fff;
        border: none;
        margin-bottom: 5px;
        border-radius: 8px;
    }

    .btn-primary {
        background-color: #6AA8A2;
        border: none;
    }

    .btn-primary:hover {
        background-color: #5a8d87;
    }

    .bukti-pembayaran {
        max-width: 100%;
        border-radius: 10px;
        margin-top: 15px;
        border: 2px solid rgba(255, 255, 255, 0.2);
    }
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="overlay"></div>
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8 form-container text-center">
            <h2 class="fw-bold mb-4">Pendaftaran Berhasil!</h2>
            <p class="mb-4">
                Terima kasih, <strong><?= esc($pendaftaran['nama_lengkap']) ?></strong>.
                Pendaftaran Anda untuk event <strong><?= esc($pendaftaran['nama_event']) ?></strong> telah berhasil.
            </p>

            <div class="mb-4 text-start">
                <h5>Ringkasan Pendaftaran</h5>
                <ul class="list-group">
                    <li class="list-group-item"><strong>Nama Peserta:</strong> <?= esc($pendaftaran['nama_lengkap']) ?></li>
                    <li class="list-group-item"><strong>Event:</strong> <?= esc($pendaftaran['nama_event']) ?></li>
                    <li class="list-group-item"><strong>Kategori:</strong> <?= esc($pendaftaran['nama_kategori']) ?></li>
                    <li class="list-group-item"><strong>Rute:</strong> <?= esc($pendaftaran['rute']) ?></li>
                    <li class="list-group-item"><strong>Biaya:</strong> Rp<?= number_format($pendaftaran['biaya'], 0, ',', '.') ?></li>
                    <li class="list-group-item"><strong>Ukuran Kaos:</strong> <?= esc($pendaftaran['ukuran_kaos']) ?></li>
                    <li class="list-group-item"><strong>Status Pembayaran:</strong> <?= esc(ucfirst($pendaftaran['status_pembayaran'])) ?></li>
                </ul>

                <?php if (!empty($pendaftaran['bukti_pembayaran'])): ?>
                    <div class="mt-4">
                        <h5>Bukti Pembayaran</h5>
                        <img src="<?= base_url('uploads/bukti_pembayaran/' . $pendaftaran['bukti_pembayaran']) ?>" alt="Bukti Pembayaran" class="bukti-pembayaran">
                    </div>
                <?php endif; ?>
            </div>

            <a href="<?= base_url('pengguna/berandaLogin') ?>" class="btn btn-primary btn-lg mt-3">Kembali ke Beranda</a>
        </div>
    </div>
</div>

<!-- SWEETALERT2 SCRIPT -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Cek jika ada session pendaftaran_success
        const pendaftaranSuccess = <?= session()->getFlashdata('pendaftaran_success') ? 'true' : 'false' ?>;
        const namaPeserta = "<?= esc($pendaftaran['nama_lengkap']) ?>";
        const namaEvent = "<?= esc($pendaftaran['nama_event']) ?>";
        const statusPembayaran = "<?= esc($pendaftaran['status_pembayaran']) ?>";

        if (pendaftaranSuccess) {
            let title, text;

            if (statusPembayaran === 'lunas') {
                title = 'Pembayaran Berhasil!';
                text = `Terima kasih ${namaPeserta}! Pembayaran untuk event ${namaEvent} telah berhasil diverifikasi.`;
            } else if (statusPembayaran === 'pending') {
                title = 'Pendaftaran Berhasil!';
                text = `Terima kasih ${namaPeserta}! Pendaftaran Anda untuk event ${namaEvent} berhasil. Silakan tunggu verifikasi pembayaran.`;
            } else {
                title = 'Pendaftaran Berhasil!';
                text = `Terima kasih ${namaPeserta}! Pendaftaran Anda untuk event ${namaEvent} telah berhasil.`;
            }

            Swal.fire({
                title: title,
                text: text,
                icon: 'success',
                confirmButtonColor: '#6AA8A2',
                confirmButtonText: 'Mengerti',
                timer: 5000,
                timerProgressBar: true,
                didOpen: () => {
                    Swal.showLoading();
                }
            });
        }
    });
</script>

<?= $this->endSection() ?>
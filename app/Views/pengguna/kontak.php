<?= $this->extend('layouts/pengguna') ?>

<?= $this->section('title') ?>
Kontak
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-5 mb-4">
            <h2 class="mb-4 fw-bold">Hubungi Kami</h2>
            <p class="text-muted">
                Jika Anda memiliki pertanyaan atau membutuhkan informasi lebih lanjut, silakan hubungi kami melalui kontak berikut:
            </p>
            <ul class="list-unstyled">
                <li class="mb-3">
                    <i class="fas fa-map-marker-alt me-2 text-primary"></i>
                    Jl. Contoh No.123, Jakarta
                </li>
                <li class="mb-3">
                    <i class="fas fa-phone me-2 text-primary"></i>
                    +62 812-3456-7890
                </li>
                <li class="mb-3">
                    <i class="fas fa-envelope me-2 text-primary"></i>
                    support@eventolahraga.com
                </li>
            </ul>
        </div>

        <!-- Form Kontak -->
        <div class="col-lg-6">
            <div class="card shadow-sm border-0">
                <div class="card-body p-4">
                    <h4 class="mb-3 fw-semibold">Kirim Pesan</h4>
                    <form action="<?= base_url('kontak/send') ?>" method="post">
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan nama Anda" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Alamat Email</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="nama@email.com" required>
                        </div>
                        <div class="mb-3">
                            <label for="pesan" class="form-label">Pesan</label>
                            <textarea class="form-control" id="pesan" name="pesan" rows="4" placeholder="Tulis pesan Anda di sini..." required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Kirim Pesan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
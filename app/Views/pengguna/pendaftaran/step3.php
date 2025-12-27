<?= $this->extend('layouts/pengguna') ?>

<?= $this->section('title') ?>
Pendaftaran - Step 3
<?= $this->endSection() ?>

<?= $this->section('styles') ?>
<style>
    body {
        background: url('<?= base_url('img/carousel/2.png') ?>') no-repeat center center fixed;
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

    .form-label {
        color: #fff;
    }

    .form-control,
    .form-select,
    textarea {
        background-color: rgba(255, 255, 255, 0.2);
        border: none;
        color: #fff;
    }

    .form-control:focus,
    .form-select:focus,
    textarea:focus {
        background-color: rgba(255, 255, 255, 0.3);
        color: #fff;
        box-shadow: none;
    }

    .form-select option {
        color: #fff;
        background-color: #333;
    }

    .btn-primary {
        background-color: #6AA8A2;
        border: none;
    }

    .btn-primary:hover {
        background-color: #5a8d87;
    }

    .qr-code {
        max-width: 200px;
        border-radius: 10px;
        border: 2px solid rgba(255, 255, 255, 0.2);
    }

    .preview-img {
        display: none;
        max-height: 150px;
        margin-top: 15px;
        border-radius: 8px;
        border: 2px solid rgba(255, 255, 255, 0.2);
    }
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="overlay"></div>
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8 form-container">
            <h2 class="fw-bold mb-4 text-center">Form Pendaftaran - Bukti Pembayaran</h2>

            <div class="mb-4">
                <h5>Ringkasan Pendaftaran</h5>
                <ul class="list-group">
                    <li class="list-group-item"><strong>Nama Peserta:</strong> <?= esc($pendaftaran['nama_lengkap']) ?></li>
                    <li class="list-group-item"><strong>Event:</strong> <?= esc($pendaftaran['nama_event']) ?></li>
                    <li class="list-group-item"><strong>Kategori:</strong> <?= esc($pendaftaran['nama_kategori']) ?></li>
                    <li class="list-group-item"><strong>Rute:</strong> <?= esc($pendaftaran['rute']) ?></li>
                    <li class="list-group-item"><strong>Biaya:</strong> Rp<?= number_format($pendaftaran['biaya'], 0, ',', '.') ?></li>
                    <li class="list-group-item"><strong>Ukuran Kaos:</strong> <?= esc($pendaftaran['ukuran_kaos']) ?></li>
                </ul>
            </div>

            <div class="mb-4 text-center">
                <h5>QR Code Pembayaran</h5>
                <img src="<?= esc(base_url('img/qr-code.png')) ?>" alt="QR Code" class="img-fluid qr-code">
            </div>

            <form action="<?= base_url('pengguna/pendaftaran/saveStep3/' . $pendaftaran['id']) ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field() ?>

                <div class="mb-3">
                    <label for="jumlah_pembayaran" class="form-label">Jumlah Pembayaran</label>
                    <input type="number" class="form-control" id="jumlah_pembayaran" name="jumlah_pembayaran"
                        value="<?= esc($pendaftaran['biaya']) ?>" required>
                </div>

                <div class="mb-3">
                    <label for="bukti_pembayaran" class="form-label">Upload Bukti Pembayaran</label>
                    <input type="file" class="form-control" id="bukti_pembayaran" name="bukti_pembayaran" accept="image/*" required>
                    <img id="preview" class="preview-img" alt="Preview Bukti Pembayaran">
                </div>

                <div class="text-end mt-4">
                    <button type="submit" class="btn btn-primary btn-lg">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.getElementById('bukti_pembayaran').addEventListener('change', function(e) {
        const file = e.target.files[0];
        const preview = document.getElementById('preview');
        if (file) {
            preview.style.display = 'block';
            preview.src = URL.createObjectURL(file);
        } else {
            preview.style.display = 'none';
        }
    });
</script>
<?= $this->endSection() ?>
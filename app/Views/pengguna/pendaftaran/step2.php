<?= $this->extend('layouts/pengguna') ?>

<?= $this->section('title') ?>
Pendaftaran - Step 2
<?= $this->endSection() ?>

<?= $this->section('styles') ?>
<style>
    body {
        background: url('<?= base_url('img/carousel/3.png') ?>') no-repeat center center fixed;
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

    .form-label,
    h2,
    h5 {
        color: #fff;
    }

    /* Input fields dengan background transparan */
    .form-control,
    .form-select,
    textarea {
        background-color: rgba(255, 255, 255, 0.2);
        border: none;
        color: #fff;
        transition: all 0.3s ease;
    }

    /* Input fields yang readonly (nama event, kategori, rute, biaya, nama bib) */
    .form-control[readonly] {
        background-color: rgba(255, 255, 255, 0.3);
        color: #fff;
    }

    /* Ketika input field aktif/focus */
    .form-control:focus,
    .form-select:focus,
    textarea:focus {
        background-color: rgba(255, 255, 255, 0.9);
        color: #000 !important;
        box-shadow: none;
    }

    /* Untuk memastikan teks tetap terbaca saat background putih */
    .form-control:focus::placeholder {
        color: #666;
    }

    /* Option dropdown */
    .form-select option {
        color: #000;
        background-color: #fff;
    }

    /* Textarea */
    textarea {
        color: #fff;
    }

    textarea:focus {
        color: #000 !important;
    }

    .btn-primary {
        background-color: #6AA8A2;
        border: none;
    }

    .btn-primary:hover {
        background-color: #5a8d87;
    }

    /* Placeholder color */
    .form-control::placeholder {
        color: rgba(255, 255, 255, 0.7);
    }

    .form-control:focus::placeholder {
        color: rgba(0, 0, 0, 0.5);
    }

    /* Form check styling */
    .form-check-input {
        background-color: rgba(255, 255, 255, 0.2);
        border: 1px solid rgba(255, 255, 255, 0.5);
    }

    .form-check-input:checked {
        background-color: #6AA8A2;
        border-color: #6AA8A2;
    }

    .form-check-label {
        color: #fff;
    }
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="overlay"></div>
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8 form-container">
            <h2 class="fw-bold mb-5 text-center">Form Pendaftaran Event</h2>

            <form action="<?= base_url('pengguna/pendaftaran/saveStep2/' . $pendaftaranId) ?>" method="post">
                <?= csrf_field() ?>

                <input type="hidden" name="event_id" value="<?= esc($event['id']) ?>">
                <input type="hidden" name="kategori_event_id" value="<?= esc($kategori['id']) ?>">

                <div class="mb-4">
                    <label class="form-label">Nama Event</label>
                    <input type="text" class="form-control" value="<?= esc($event['nama_event']) ?>" readonly>
                </div>

                <div class="mb-4">
                    <label class="form-label">Kategori Event</label>
                    <input type="text" class="form-control" value="<?= esc($kategori['nama_kategori']) ?>" readonly>
                </div>

                <div class="mb-3">
                    <label class="form-label">Rute</label>
                    <input type="text" class="form-control" value="<?= esc($kategori['rute']) ?>" readonly>
                </div>

                <div class="mb-3">
                    <label class="form-label">Biaya</label>
                    <input type="text" class="form-control" value="Rp<?= number_format($kategori['biaya'], 0, ',', '.') ?>" readonly>
                </div>

                <div class="mb-3">
                    <label class="form-label">Nama Bib</label>
                    <input type="text" class="form-control" value="<?= esc(session()->get('username')) ?>" readonly>
                </div>

                <div class="mb-4">
                    <label for="ukuran_kaos" class="form-label">Ukuran Kaos</label>
                    <select class="form-select" id="ukuran_kaos" name="ukuran_kaos" required>
                        <option value="">-- Pilih Ukuran --</option>
                        <option value="S">S</option>
                        <option value="M">M</option>
                        <option value="L">L</option>
                        <option value="XL">XL</option>
                        <option value="XXL">XXL</option>
                    </select>
                </div>

                <div class="form-check mb-4">
                    <input class="form-check-input" type="checkbox" id="persetujuan" name="persetujuan" value="1" required>
                    <label class="form-check-label" for="persetujuan">
                        Saya menyetujui syarat & ketentuan pendaftaran event ini.
                    </label>
                </div>

                <div class="text-end">
                    <button type="submit" class="btn btn-primary btn-lg">Selanjutnya</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
<?= $this->extend('layouts/pengguna') ?>

<?= $this->section('title') ?>
Pendaftaran - Step 1
<?= $this->endSection() ?>

<?= $this->section('styles') ?>
<style>
    body {
        background: url('<?= base_url('img/carousel/1.png') ?>') no-repeat center center fixed;
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

    /* Input fields yang readonly (nama dan email) */
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

    hr {
        border-color: rgba(255, 255, 255, 0.3);
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
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<?php

use App\Models\UserModel;

// Ambil data user dari tabel `users` berdasarkan session login
$userModel = new UserModel();
$userId = session()->get('id');
$user = $userModel->find($userId);

$userName  = $user['name'] ?? '';
$userEmail = $user['email'] ?? '';
?>

<div class="overlay"></div>
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10 form-container">
            <h2 class="fw-bold mb-5 text-center">Form Pendaftaran - Data Diri</h2>

            <form action="<?= base_url('pengguna/pendaftaran/saveStep1') ?>" method="post">
                <?= csrf_field() ?>

                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                        <input type="text"
                            class="form-control"
                            id="nama_lengkap"
                            name="nama_lengkap"
                            value="<?= esc($userName) ?>"
                            readonly required>
                    </div>

                    <div class="col-md-6">
                        <label for="email" class="form-label">Email</label>
                        <input type="email"
                            class="form-control"
                            id="email"
                            name="email"
                            value="<?= esc($userEmail) ?>"
                            readonly required>
                    </div>

                    <div class="col-md-6">
                        <label for="no_tlp" class="form-label">No. Telepon</label>
                        <input type="number" class="form-control" id="no_tlp" name="no_tlp" placeholder="Contoh: 081234567890" required>
                    </div>

                    <div class="col-md-6">
                        <label for="alamat_lengkap" class="form-label">Alamat Lengkap</label>
                        <textarea class="form-control" id="alamat_lengkap" name="alamat_lengkap" rows="1" placeholder="Isi alamat lengkap Anda" required></textarea>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Provinsi</label>
                        <select id="provinsi" class="form-select" required>
                            <option value="">-- Pilih Provinsi --</option>
                        </select>
                        <input type="hidden" name="provinsi" id="provinsi_name">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Kabupaten / Kota</label>
                        <select id="kabupaten" class="form-select" required>
                            <option value="">-- Pilih Kabupaten --</option>
                        </select>
                        <input type="hidden" name="kabupaten" id="kabupaten_name">
                    </div>

                    <div class="col-md-6">
                        <label for="kewarganegaraan" class="form-label">Kewarganegaraan</label>
                        <input type="text" class="form-control" id="kewarganegaraan" name="kewarganegaraan" placeholder="Contoh: Indonesia" required>
                    </div>

                    <div class="col-md-6">
                        <label for="no_identitas" class="form-label">No. Identitas</label>
                        <input type="text" class="form-control" id="no_identitas" name="no_identitas" placeholder="Contoh: 3471012345678901" required>
                    </div>

                    <div class="col-md-6">
                        <label for="goldar" class="form-label">Golongan Darah</label>
                        <select id="goldar" name="goldar" class="form-select">
                            <option value="">Pilih Golongan Darah</option>
                            <option value="A+">A+</option>
                            <option value="A-">A-</option>
                            <option value="B+">B+</option>
                            <option value="B-">B-</option>
                            <option value="AB+">AB+</option>
                            <option value="AB-">AB-</option>
                            <option value="O+">O+</option>
                            <option value="O-">O-</option>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                        <select class="form-select" id="jenis_kelamin" name="jenis_kelamin" required>
                            <option value="">Pilih...</option>
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                        <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" required>
                    </div>

                    <div class="col-md-6">
                        <label for="riwayat_penyakit" class="form-label">Riwayat Penyakit</label>
                        <textarea class="form-control" id="riwayat_penyakit" name="riwayat_penyakit" rows="1" placeholder="Kosongkan jika tidak ada"></textarea>
                    </div>
                </div>

                <hr class="my-4">
                <h5 class="fw-bold mb-3">Kontak Darurat</h5>

                <div class="row g-3">
                    <div class="col-md-4">
                        <label for="kontak_darurat_nama" class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control" id="kontak_darurat_nama" name="kontak_darurat_nama" placeholder="Nama kontak darurat" required>
                    </div>
                    <div class="col-md-4">
                        <label for="kontak_darurat_hp" class="form-label">No. HP</label>
                        <input type="number" class="form-control" id="kontak_darurat_hp" name="kontak_darurat_hp" placeholder="Contoh: 081234567890" required>
                    </div>
                    <div class="col-md-4">
                        <label for="kontak_darurat_hubungan" class="form-label">Hubungan</label>
                        <input type="text" class="form-control" id="kontak_darurat_hubungan" name="kontak_darurat_hubungan" placeholder="Contoh: Saudara, Teman" required>
                    </div>
                </div>

                <div class="text-end mt-4">
                    <button type="submit" class="btn btn-primary btn-lg">Selanjutnya</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const provinsiSelect = document.getElementById('provinsi');
        const kabupatenSelect = document.getElementById('kabupaten');

        const provinsiName = document.getElementById('provinsi_name');
        const kabupatenName = document.getElementById('kabupaten_name');

        function loadProvinces() {
            fetch('https://www.emsifa.com/api-wilayah-indonesia/api/provinces.json')
                .then(res => res.json())
                .then(data => {
                    provinsiSelect.innerHTML = '<option value="">-- Pilih Provinsi --</option>';
                    data.forEach(p => {
                        provinsiSelect.innerHTML += `<option value="${p.id}" data-name="${p.name}">${p.name}</option>`;
                    });
                });
        }

        function loadKabupaten(provId) {
            kabupatenSelect.innerHTML = '<option value="">Loading...</option>';
            fetch(`https://www.emsifa.com/api-wilayah-indonesia/api/regencies/${provId}.json`)
                .then(res => res.json())
                .then(data => {
                    kabupatenSelect.innerHTML = '<option value="">-- Pilih Kabupaten --</option>';
                    data.forEach(k => {
                        kabupatenSelect.innerHTML += `<option value="${k.id}" data-name="${k.name}">${k.name}</option>`;
                    });
                });
        }

        provinsiSelect.addEventListener('change', e => {
            const selected = e.target.selectedOptions[0];
            provinsiName.value = selected ? selected.dataset.name : '';
            loadKabupaten(e.target.value);
            kabupatenSelect.innerHTML = '';
        });

        kabupatenSelect.addEventListener('change', e => {
            const selected = e.target.selectedOptions[0];
            kabupatenName.value = selected ? selected.dataset.name : '';
        });

        loadProvinces();
    });
</script>

<?= $this->endSection() ?>
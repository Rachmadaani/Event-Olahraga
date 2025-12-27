<?= $this->extend('layouts/admin') ?>

<?= $this->section('title') ?>
Event
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between align-items-center w-100">
            <h3 class="card-title mb-0">
                <i class="fas fa-calendar-alt mr-2 text-secondary"></i> Data Event
            </h3>
            <button type="button" class="btn btn-sm btn-secondary" data-toggle="modal" data-target="#modalTambah">
                <i class="fas fa-plus"></i> Tambah Event
            </button>
        </div>
    </div>

    <div class="card-body">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Event</th>
                    <th>Tanggal Event</th>
                    <th>Provinsi</th>
                    <th>Kabupaten/Kota</th>
                    <th>Kecamatan</th>
                    <th>Kelurahan/Desa</th>
                    <th>Link Lokasi</th>
                    <th>Deskripsi Event</th>
                    <th>Gambar Event</th>
                    <th>Nama Ketua Panitia</th>
                    <th>No HP</th>
                    <th>Tanda Tangan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1;
                foreach ($events as $event): ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= esc($event['nama_event']) ?></td>
                        <td><?= esc($event['tanggal_event']) ?></td>

                        <!-- 🆕 Tambahan kolom wilayah -->
                        <td><?= esc($event['provinsi']) ?></td>
                        <td><?= esc($event['kabupaten']) ?></td>
                        <td><?= esc($event['kecamatan']) ?></td>
                        <td><?= esc($event['kelurahan']) ?></td>

                        <!-- Link Google Maps -->
                        <td>
                            <a href="<?= esc($event['lokasi']) ?>" target="_blank" class="btn btn-link">
                                Lihat Lokasi
                            </a>
                        </td>

                        <td><?= esc($event['deskripsi']) ?></td>

                        <td>
                            <?php if ($event['gambar']): ?>
                                <img src="<?= base_url('uploads/event/gambar/' . $event['gambar']) ?>" width="80" alt="Gambar Event">
                            <?php endif; ?>
                        </td>

                        <td><?= esc($event['nama_panitia']) ?></td>
                        <td><?= esc($event['no_hp_panitia']) ?></td>

                        <td>
                            <?php if ($event['ttd_panitia']): ?>
                                <img src="<?= base_url('uploads/event/ttd/' . $event['ttd_panitia']) ?>" width="80" alt="TTD Panitia">
                            <?php endif; ?>
                        </td>

                        <td>
                            <button type="button" class="btn btn-warning btn-sm"
                                data-toggle="modal" data-target="#modalEdit<?= $event['id'] ?>">
                                <i class="fas fa-edit"></i>
                            </button>
                            <a href="<?= base_url('admin/event/delete/' . $event['id']) ?>"
                                class="btn btn-danger btn-sm btn-delete"
                                data-url="<?= base_url('admin/event/delete/' . $event['id']) ?>">
                                <i class="fas fa-trash"></i>
                            </a>
                        </td>
                    </tr>

                    <!-- Modal Edit -->
                    <div class="modal fade" id="modalEdit<?= $event['id'] ?>" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <form action="<?= base_url('admin/event/update/' . $event['id']) ?>" method="post" enctype="multipart/form-data">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Edit Event</h5>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Nama Event</label>
                                                    <input type="text" name="nama_event" class="form-control"
                                                        value="<?= esc($event['nama_event']) ?>" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Tanggal Event</label>
                                                    <input type="date" name="tanggal_event" class="form-control"
                                                        value="<?= esc($event['tanggal_event']) ?>" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Provinsi</label>
                                                    <select id="provinsi_edit_<?= $event['id'] ?>" name="provinsi" class="form-control" required>
                                                        <option value="">-- Pilih Provinsi --</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Kabupaten / Kota</label>
                                                    <select id="kabupaten_edit_<?= $event['id'] ?>" name="kabupaten" class="form-control" required>
                                                        <option value="">-- Pilih Kabupaten/Kota --</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Kecamatan</label>
                                                    <select id="kecamatan_edit_<?= $event['id'] ?>" name="kecamatan" class="form-control" required>
                                                        <option value="">-- Pilih Kecamatan --</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Kelurahan / Desa</label>
                                                    <select id="kelurahan_edit_<?= $event['id'] ?>" name="kelurahan" class="form-control" required>
                                                        <option value="">-- Pilih Kelurahan/Desa --</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Link Google Maps Lokasi</label>
                                            <input type="url" name="lokasi" class="form-control"
                                                placeholder="https://maps.google.com/..." value="<?= esc($event['lokasi']) ?>" required>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Nama Ketua Panitia</label>
                                                    <input type="text" name="nama_panitia" class="form-control"
                                                        value="<?= esc($event['nama_panitia']) ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>No hp Ketua Panitia</label>
                                                    <input type="number" name="no_hp_panitia" class="form-control"
                                                        value="<?= esc($event['no_hp_panitia']) ?>">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Gambar Event</label>
                                                    <input type="file" name="gambar" class="form-control">
                                                    <?php if (!empty($event['gambar'])): ?>
                                                        <small class="text-muted d-block mt-1">File saat ini: <?= esc($event['gambar']) ?></small>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Tanda Tangan Ketua Panitia</label>
                                                    <input type="file" name="ttd_panitia" class="form-control">
                                                    <?php if (!empty($event['ttd_panitia'])): ?>
                                                        <small class="text-muted d-block mt-1">File saat ini: <?= esc($event['ttd_panitia']) ?></small>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label>Deskripsi Event</label>
                                            <textarea name="deskripsi" class="form-control" rows="3"><?= esc($event['deskripsi']) ?></textarea>
                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>


                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Tambah -->
<div class="modal fade" id="modalTambah" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="<?= base_url('admin/event/store') ?>" method="post" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Event</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nama Event</label>
                                <input type="text" name="nama_event" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Tanggal Event</label>
                            <input type="date" name="tanggal_event" class="form-control" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Provinsi</label>
                                <select id="provinsi" class="form-control" required></select>
                                <input type="hidden" name="provinsi" id="provinsi_name">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Kabupaten / Kota</label>
                                <select id="kabupaten" class="form-control" required></select>
                                <input type="hidden" name="kabupaten" id="kabupaten_name">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Kecamatan</label>
                                <select id="kecamatan" class="form-control" required></select>
                                <input type="hidden" name="kecamatan" id="kecamatan_name">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Kelurahan / Desa</label>
                                <select id="kelurahan" class="form-control" required></select>
                                <input type="hidden" name="kelurahan" id="kelurahan_name">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Link Google Maps Lokasi</label>
                        <input type="url" name="lokasi" class="form-control" placeholder="https://maps.google.com/..." required>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nama Ketua Panitia</label>
                                <input type="text" name="nama_panitia" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>No hp Ketua Panitia</label>
                                <input type="number" name="no_hp_panitia" class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Gambar Event</label>
                                <input type="file" name="gambar" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Tanda Tangan Ketua Panitia</label>
                                <input type="file" name="ttd_panitia" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Deskripsi Event</label>
                        <textarea name="deskripsi" class="form-control" rows="3"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
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
        const kecamatanSelect = document.getElementById('kecamatan');
        const kelurahanSelect = document.getElementById('kelurahan');

        const provinsiName = document.getElementById('provinsi_name');
        const kabupatenName = document.getElementById('kabupaten_name');
        const kecamatanName = document.getElementById('kecamatan_name');
        const kelurahanName = document.getElementById('kelurahan_name');

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

        function loadKecamatan(kabId) {
            kecamatanSelect.innerHTML = '<option value="">Loading...</option>';
            fetch(`https://www.emsifa.com/api-wilayah-indonesia/api/districts/${kabId}.json`)
                .then(res => res.json())
                .then(data => {
                    kecamatanSelect.innerHTML = '<option value="">-- Pilih Kecamatan --</option>';
                    data.forEach(kec => {
                        kecamatanSelect.innerHTML += `<option value="${kec.id}" data-name="${kec.name}">${kec.name}</option>`;
                    });
                });
        }

        function loadKelurahan(kecId) {
            kelurahanSelect.innerHTML = '<option value="">Loading...</option>';
            fetch(`https://www.emsifa.com/api-wilayah-indonesia/api/villages/${kecId}.json`)
                .then(res => res.json())
                .then(data => {
                    kelurahanSelect.innerHTML = '<option value="">-- Pilih Kelurahan --</option>';
                    data.forEach(kel => {
                        kelurahanSelect.innerHTML += `<option value="${kel.id}" data-name="${kel.name}">${kel.name}</option>`;
                    });
                });
        }
        provinsiSelect.addEventListener('change', e => {
            const selected = e.target.selectedOptions[0];
            provinsiName.value = selected ? selected.dataset.name : '';
            loadKabupaten(e.target.value);
            kabupatenSelect.innerHTML = '';
            kecamatanSelect.innerHTML = '';
            kelurahanSelect.innerHTML = '';
        });

        kabupatenSelect.addEventListener('change', e => {
            const selected = e.target.selectedOptions[0];
            kabupatenName.value = selected ? selected.dataset.name : '';
            loadKecamatan(e.target.value);
            kecamatanSelect.innerHTML = '';
            kelurahanSelect.innerHTML = '';
        });

        kecamatanSelect.addEventListener('change', e => {
            const selected = e.target.selectedOptions[0];
            kecamatanName.value = selected ? selected.dataset.name : '';
            loadKelurahan(e.target.value);
            kelurahanSelect.innerHTML = '';
        });

        kelurahanSelect.addEventListener('change', e => {
            const selected = e.target.selectedOptions[0];
            kelurahanName.value = selected ? selected.dataset.name : '';
        });

        loadProvinces();
    });
</script>


<script>
    function loadWilayahEdit(modalId, provVal, kabVal, kecVal, kelVal) {
        const provSel = $('#provinsi_edit_' + modalId);
        const kabSel = $('#kabupaten_edit_' + modalId);
        const kecSel = $('#kecamatan_edit_' + modalId);
        const kelSel = $('#kelurahan_edit_' + modalId);

        function getData(url, callback) {
            if (localStorage.getItem(url)) {
                callback(JSON.parse(localStorage.getItem(url)));
            } else {
                $.getJSON(url, function(data) {
                    localStorage.setItem(url, JSON.stringify(data));
                    callback(data);
                });
            }
        }

        // === PROVINSI ===
        getData('https://www.emsifa.com/api-wilayah-indonesia/api/provinces.json', function(data) {
            provSel.html('<option value="">-- Pilih Provinsi --</option>');
            $.each(data, function(i, val) {
                // pakai val.name sebagai value
                provSel.append('<option value="' + val.name + '"' + (provVal == val.name ? ' selected' : '') + '>' + val.name + '</option>');
            });
            if (provVal) loadKabupaten(provVal);
        });

        // === KABUPATEN ===
        function loadKabupaten(provName) {
            getData('https://www.emsifa.com/api-wilayah-indonesia/api/provinces.json', function(provData) {
                const prov = provData.find(p => p.name === provName);
                if (!prov) return;
                getData('https://www.emsifa.com/api-wilayah-indonesia/api/regencies/' + prov.id + '.json', function(data) {
                    kabSel.html('<option value="">-- Pilih Kabupaten/Kota --</option>');
                    $.each(data, function(i, val) {
                        kabSel.append('<option value="' + val.name + '"' + (kabVal == val.name ? ' selected' : '') + '>' + val.name + '</option>');
                    });
                    if (kabVal) loadKecamatan(kabVal);
                });
            });
        }

        // === KECAMATAN ===
        function loadKecamatan(kabName) {
            getData('https://www.emsifa.com/api-wilayah-indonesia/api/regencies.json', function() {
                getData('https://www.emsifa.com/api-wilayah-indonesia/api/regencies.json', function() {}); // dummy
            });
            getData('https://www.emsifa.com/api-wilayah-indonesia/api/regencies.json', function() {}); // dummy
            getData('https://www.emsifa.com/api-wilayah-indonesia/api/regencies.json', function() {}); // dummy

            // cari id kabupaten dari nama
            getData('https://www.emsifa.com/api-wilayah-indonesia/api/regencies.json', function() {}); // dummy
        }

        // === Fungsi KECAMATAN & KELURAHAN diperbaiki ===
        function loadKecamatan(kabName) {
            // cari ID kabupaten dari nama
            getData('https://www.emsifa.com/api-wilayah-indonesia/api/regencies/' + provSel.find('option:selected').text() + '.json', function() {});
        }

        function loadKecamatanByProv(provName, kabName) {
            getData('https://www.emsifa.com/api-wilayah-indonesia/api/provinces.json', function(provData) {
                const prov = provData.find(p => p.name === provName);
                if (!prov) return;
                getData('https://www.emsifa.com/api-wilayah-indonesia/api/regencies/' + prov.id + '.json', function(kabData) {
                    const kab = kabData.find(k => k.name === kabName);
                    if (!kab) return;
                    getData('https://www.emsifa.com/api-wilayah-indonesia/api/districts/' + kab.id + '.json', function(data) {
                        kecSel.html('<option value="">-- Pilih Kecamatan --</option>');
                        $.each(data, function(i, val) {
                            kecSel.append('<option value="' + val.name + '"' + (kecVal == val.name ? ' selected' : '') + '>' + val.name + '</option>');
                        });
                        if (kecVal) loadKelurahan(kecVal, provName, kabName);
                    });
                });
            });
        }

        function loadKelurahan(kecName, provName, kabName) {
            getData('https://www.emsifa.com/api-wilayah-indonesia/api/provinces.json', function(provData) {
                const prov = provData.find(p => p.name === provName);
                if (!prov) return;
                getData('https://www.emsifa.com/api-wilayah-indonesia/api/regencies/' + prov.id + '.json', function(kabData) {
                    const kab = kabData.find(k => k.name === kabName);
                    if (!kab) return;
                    getData('https://www.emsifa.com/api-wilayah-indonesia/api/districts/' + kab.id + '.json', function(kecData) {
                        const kec = kecData.find(k => k.name === kecName);
                        if (!kec) return;
                        getData('https://www.emsifa.com/api-wilayah-indonesia/api/villages/' + kec.id + '.json', function(data) {
                            kelSel.html('<option value="">-- Pilih Kelurahan/Desa --</option>');
                            $.each(data, function(i, val) {
                                kelSel.append('<option value="' + val.name + '"' + (kelVal == val.name ? ' selected' : '') + '>' + val.name + '</option>');
                            });
                        });
                    });
                });
            });
        }

        // event onchange agar tetap menampilkan nama
        provSel.on('change', function() {
            kabSel.html('<option value="">Loading...</option>');
            loadKabupaten(this.value);
        });
        kabSel.on('change', function() {
            kecSel.html('<option value="">Loading...</option>');
            loadKecamatanByProv(provSel.val(), this.value);
        });
        kecSel.on('change', function() {
            kelSel.html('<option value="">Loading...</option>');
            loadKelurahan(this.value, provSel.val(), kabSel.val());
        });
    }

    <?php foreach ($events as $event): ?>
        loadWilayahEdit(
            '<?= $event['id'] ?>',
            '<?= $event['provinsi'] ?>',
            '<?= $event['kabupaten'] ?>',
            '<?= $event['kecamatan'] ?>',
            '<?= $event['kelurahan'] ?>'
        );
    <?php endforeach; ?>
</script>



<?= $this->endSection() ?>
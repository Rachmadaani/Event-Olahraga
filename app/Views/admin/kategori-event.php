<?= $this->extend('layouts/admin') ?>

<?= $this->section('title') ?>
Kategori Event
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between align-items-center w-100">
            <h3 class="card-title mb-0">
                <i class="fas fa-calendar-alt mr-2 text-secondary"></i> Data Kategori Event
            </h3>
            <button type="button" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#modalTambah">
                <i class="fas fa-plus"></i> Tambah Kategori
            </button>
        </div>
    </div>
    <div class="card-body">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Event</th>
                    <th>Kategori</th>
                    <th>Deskripsi Fasilitas</th>
                    <th>Berbayar</th>
                    <th>Biaya</th>
                    <th>Race Kategory</th>
                    <th>Tanggal Mulai</th>
                    <th>Jam Mulai</th>
                    <th>Batas Waktu</th>
                    <th>Keterangan Tambahan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1;
                foreach ($kategori_event as $kat): ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= esc($kat['nama_event']) ?></td>
                        <td><?= esc($kat['nama_kategori']) ?></td>
                        <td><?= esc($kat['deskripsi']) ?></td>
                        <td><?= ucfirst($kat['berbayar']) ?></td>
                        <td><?= $kat['biaya'] ? "Rp " . number_format($kat['biaya'], 0, ',', '.') : '-' ?></td>
                        <td><?= esc($kat['rute']) ?></td>
                        <td><?= esc($kat['tanggal_mulai']) ?></td>
                        <td><?= esc($kat['jam_mulai']) ?></td>
                        <td><?= esc($kat['batas_waktu']) ?></td>
                        <td><?= esc($kat['keterangan']) ?></td>
                        <td>
                            <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modalEdit<?= $kat['id'] ?>">
                                <i class="fas fa-edit"></i>
                            </button>
                            <a href="<?= base_url('admin/kategori-event/delete/' . $kat['id']) ?>" class="btn btn-danger btn-sm btn-delete" data-url="<?= base_url('admin/kategori-event/delete/' . $kat['id']) ?>">
                                <i class="fas fa-trash"></i>
                            </a>
                        </td>
                    </tr>

                    <!-- Modal Edit -->
                    <div class="modal fade" id="modalEdit<?= $kat['id'] ?>" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <form action="<?= base_url('admin/kategori-event/update/' . $kat['id']) ?>" method="post">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Edit Kategori</h5>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <label>Event</label>
                                                <select name="event_id" class="form-control" required>
                                                    <?php foreach ($events as $ev): ?>
                                                        <option value="<?= $ev['id'] ?>" data-tanggal="<?= $ev['tanggal_event'] ?>" <?= $kat['event_id'] == $ev['id'] ? 'selected' : '' ?>>
                                                            <?= esc($ev['nama_event']) ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label>Nama Kategori</label>
                                                <input type="text" name="nama_kategori" class="form-control" value="<?= esc($kat['nama_kategori']) ?>" required>
                                            </div>
                                            <div class="form-group col-md-12">
                                                <label>Deskripsi Fasilitas</label>
                                                <textarea name="deskripsi" class="form-control"><?= esc($kat['deskripsi']) ?></textarea>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label>Berbayar / Gratis</label>
                                                <select name="berbayar" class="form-control select-berbayar" data-id="<?= $kat['id'] ?>" required>
                                                    <option value="gratis" <?= $kat['berbayar'] == 'gratis' ? 'selected' : '' ?>>Gratis</option>
                                                    <option value="berbayar" <?= $kat['berbayar'] == 'berbayar' ? 'selected' : '' ?>>Berbayar</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-6 biaya-group" id="biaya-group-<?= $kat['id'] ?>" style="display: <?= $kat['berbayar'] == 'berbayar' ? 'block' : 'none' ?>;">
                                                <label>Biaya</label>
                                                <input type="number" name="biaya" class="form-control" value="<?= esc($kat['biaya']) ?>">
                                            </div>
                                            <div class="form-group col-md-12">
                                                <label>Race Kategory</label>
                                                <textarea name="rute" class="form-control"><?= esc($kat['rute']) ?></textarea>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label>Tanggal Mulai</label>
                                                <input type="date" name="tanggal_mulai" class="form-control" value="<?= esc($kat['tanggal_mulai']) ?>" readonly>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label>Jam Mulai</label>
                                                <input type="time" name="jam_mulai" class="form-control" value="<?= esc($kat['jam_mulai']) ?>">
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label>Batas Waktu</label>
                                                <input type="datetime-local" name="batas_waktu" class="form-control" value="<?= esc(str_replace(' ', 'T', $kat['batas_waktu'])) ?>">
                                            </div>
                                            <div class="form-group col-md-12">
                                                <label>Keterangan Tambahan</label>
                                                <textarea name="keterangan" class="form-control"><?= esc($kat['keterangan']) ?></textarea>
                                            </div>
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
            <form action="<?= base_url('admin/kategori-event/store') ?>" method="post">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Kategori</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>Event</label>
                            <select name="event_id" class="form-control" required>
                                <option value="">-- Pilih Event --</option>
                                <?php foreach ($events as $ev): ?>
                                    <option value="<?= $ev['id'] ?>" data-tanggal="<?= $ev['tanggal_event'] ?>">
                                        <?= esc($ev['nama_event']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Nama Kategori</label>
                            <input type="text" name="nama_kategori" class="form-control" required>
                        </div>
                        <div class="form-group col-md-12">
                            <label>Deskripsi Fasilitas</label>
                            <textarea name="deskripsi" class="form-control"></textarea>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Berbayar / Gratis</label>
                            <select name="berbayar" id="berbayar" class="form-control" required>
                                <option value="gratis">Gratis</option>
                                <option value="berbayar">Berbayar</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6" id="biaya-group" style="display: none;">
                            <label>Biaya</label>
                            <input type="number" name="biaya" id="biaya" class="form-control">
                        </div>
                        <div class="form-group col-md-12">
                            <label>Race Kategory</label>
                            <textarea name="rute" class="form-control"></textarea>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Tanggal Mulai</label>
                            <input type="date" name="tanggal_mulai" class="form-control" readonly>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Jam Mulai</label>
                            <input type="time" name="jam_mulai" class="form-control">
                        </div>
                        <div class="form-group col-md-4">
                            <label>Batas Waktu</label>
                            <input type="datetime-local" name="batas_waktu" class="form-control">
                        </div>
                        <div class="form-group col-md-12">
                            <label>Keterangan Tambahan</label>
                            <textarea name="keterangan" class="form-control"></textarea>
                        </div>
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

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // === Tampilkan input biaya jika berbayar ===
        const selectBerbayar = document.getElementById("berbayar");
        const biayaGroup = document.getElementById("biaya-group");
        const biayaInput = document.getElementById("biaya");

        function toggleBiaya() {
            if (selectBerbayar.value === "berbayar") {
                biayaGroup.style.display = "block";
                biayaInput.setAttribute("required", "required");
            } else {
                biayaGroup.style.display = "none";
                biayaInput.removeAttribute("required");
                biayaInput.value = "";
            }
        }
        selectBerbayar.addEventListener("change", toggleBiaya);
        toggleBiaya();

        document.querySelectorAll(".select-berbayar").forEach(function(select) {
            const id = select.dataset.id;
            const group = document.getElementById("biaya-group-" + id);
            const input = group.querySelector("input");

            function toggleEditBiaya() {
                if (select.value === "berbayar") {
                    group.style.display = "block";
                    input.setAttribute("required", "required");
                } else {
                    group.style.display = "none";
                    input.removeAttribute("required");
                    input.value = "";
                }
            }
            select.addEventListener("change", toggleEditBiaya);
            toggleEditBiaya();
        });

        // === Sinkronisasi tanggal_event ke tanggal_mulai ===
        const eventSelectTambah = document.querySelector("#modalTambah select[name='event_id']");
        const tanggalMulaiTambah = document.querySelector("#modalTambah input[name='tanggal_mulai']");
        if (eventSelectTambah && tanggalMulaiTambah) {
            tanggalMulaiTambah.readOnly = true;
            eventSelectTambah.addEventListener("change", function() {
                const selectedOption = this.options[this.selectedIndex];
                const tanggal = selectedOption.getAttribute("data-tanggal");
                tanggalMulaiTambah.value = tanggal || "";
            });
        }

        // === Untuk modal Edit ===
        document.querySelectorAll("div[id^='modalEdit']").forEach(function(modal) {
            const selectEvent = modal.querySelector("select[name='event_id']");
            const tanggalMulai = modal.querySelector("input[name='tanggal_mulai']");
            if (selectEvent && tanggalMulai) {
                tanggalMulai.readOnly = true;
                selectEvent.addEventListener("change", function() {
                    const selectedOption = this.options[this.selectedIndex];
                    const tanggal = selectedOption.getAttribute("data-tanggal");
                    tanggalMulai.value = tanggal || "";
                });
            }
        });
    });
</script>

<?= $this->endSection() ?>
<?= $this->extend('layouts/superadmin') ?>

<?= $this->section('title') ?>
Kategori Event
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="card">
    <div class="card-header">
        <h3 class="card-title">Data Kategori Event</h3>
    </div>
    <div class="card-body">
        <?php if (!empty($kategoriEvents)): ?>
            <?php
            // Grouping kategori event berdasarkan nama_event
            $groupedKategori = [];
            foreach ($kategoriEvents as $kat) {
                $groupedKategori[$kat['nama_event']][] = $kat;
            }
            ?>

            <?php foreach ($groupedKategori as $eventName => $kategoriList): ?>
                <h5 class="mt-4 mb-3 text-primary fw-bold border-bottom pb-2"><?= esc($eventName) ?></h5>

                <table class="table table-bordered table-striped" id="table-<?= preg_replace('/\s+/', '-', strtolower($eventName)) ?>">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Kategori</th>
                            <th>Deskripsi</th>
                            <th>Berbayar / Gratis</th>
                            <th>Biaya</th>
                            <th>Rute</th>
                            <th>Tanggal Mulai</th>
                            <th>Jam Mulai</th>
                            <th>Batas Waktu</th>
                            <th>Keterangan</th>
                            <th>Diinput Oleh</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; foreach ($kategoriList as $kat): ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= esc($kat['nama_kategori']) ?></td>
                                <td><?= esc($kat['deskripsi']) ?></td>
                                <td class="text-center">
                                    <?php if ($kat['berbayar'] == 'berbayar'): ?>
                                        <span class="badge bg-danger">Berbayar</span>
                                    <?php else: ?>
                                        <span class="badge bg-success">Gratis</span>
                                    <?php endif; ?>
                                </td>
                                <td><?= esc($kat['biaya']) ?></td>
                                <td><?= esc($kat['rute']) ?></td>
                                <td><?= esc($kat['tanggal_mulai']) ?></td>
                                <td><?= esc($kat['jam_mulai']) ?></td>
                                <td><?= esc($kat['batas_waktu']) ?></td>
                                <td><?= esc($kat['keterangan']) ?></td>
                                <td><?= esc($kat['nama_admin']) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Nama Kategori</th>
                            <th>Deskripsi</th>
                            <th>Berbayar / Gratis</th>
                            <th>Biaya</th>
                            <th>Rute</th>
                            <th>Tanggal Mulai</th>
                            <th>Jam Mulai</th>
                            <th>Batas Waktu</th>
                            <th>Keterangan</th>
                            <th>Diinput Oleh</th>
                        </tr>
                    </tfoot>
                </table>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="alert alert-warning text-center">
                Belum ada kategori event yang terdaftar.
            </div>
        <?php endif; ?>
    </div>
</div>

<!-- 🔹 DataTables JS -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.bootstrap5.min.css">

<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.colVis.min.js"></script>

<script>
$(document).ready(function() {
    <?php foreach ($groupedKategori as $eventName => $kategoriList): ?>
        $('#table-<?= preg_replace('/\s+/', '-', strtolower($eventName)) ?>').DataTable({
            "paging": true,
            "pageLength": 10,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
            "dom": '<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>><"row"<"col-sm-12"tr>><"row"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>>',
            "language": {
                "search": "Cari:",
                "lengthMenu": "Tampilkan _MENU_ entri",
                "info": "Menampilkan _START_ hingga _END_ dari _TOTAL_ entri",
                "infoEmpty": "Menampilkan 0 hingga 0 dari 0 entri",
                "infoFiltered": "(disaring dari _MAX_ total entri)",
                "paginate": {
                    "first": "Pertama",
                    "last": "Terakhir",
                    "next": "Selanjutnya",
                    "previous": "Sebelumnya"
                }
            },
            "buttons": [
                {
                    extend: 'colvis',
                    text: 'Kolom Tampil',
                    className: 'btn btn-secondary btn-sm'
                }
            ]
        });
    <?php endforeach; ?>
});
</script>

<?= $this->endSection() ?>
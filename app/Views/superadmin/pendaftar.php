<?= $this->extend('layouts/superadmin') ?>

<?= $this->section('title') ?>
Daftar Peserta
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="card">
    <div class="card-header">
        <h3 class="card-title">Daftar Peserta</h3>
    </div>
    <div class="card-body">
        <?php if (!empty($pesertas)): ?>
            <?php
            // 🔹 Grouping peserta berdasarkan nama event
            $groupedPeserta = [];
            foreach ($pesertas as $p) {
                $groupedPeserta[$p['nama_event']][] = $p;
            }
            ?>

            <?php foreach ($groupedPeserta as $eventName => $pesertaList): ?>
                <h5 class="mt-4 mb-3 text-primary fw-bold border-bottom pb-2">
                    <?= esc($eventName) ?>
                </h5>

                <table class="table table-bordered table-striped" id="table-<?= preg_replace('/\s+/', '-', strtolower($eventName)) ?>">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Peserta</th>
                            <th>Kategori Event</th>
                            <th>Status Pembayaran</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        foreach ($pesertaList as $p): ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= esc($p['nama_lengkap']) ?></td>
                                <td><?= esc($p['nama_kategori']) ?></td>
                                <td>
                                    <?php if ($p['status_pembayaran'] == 'lunas'): ?>
                                        <span class="badge bg-success">Lunas</span>
                                    <?php elseif ($p['status_pembayaran'] == 'gagal'): ?>
                                        <span class="badge bg-danger">Gagal</span>
                                    <?php else: ?>
                                        <span class="badge bg-warning text-dark">Pending</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Nama Peserta</th>
                            <th>Kategori Event</th>
                            <th>Status Pembayaran</th>
                        </tr>
                    </tfoot>
                </table>
            <?php endforeach; ?>

        <?php else: ?>
            <div class="alert alert-warning text-center">
                Belum ada peserta yang terdaftar.
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
    <?php foreach ($groupedPeserta as $eventName => $pesertaList): ?>
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
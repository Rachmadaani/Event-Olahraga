<?= $this->extend('layouts/superadmin') ?>

<?= $this->section('title') ?>
Event
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="card">
    <div class="card-header">
        <h3 class="card-title">Data Event</h3>
    </div>
    <div class="card-body">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Event</th>
                    <th>Tanggal Event</th>
                    <th>Lokasi</th>
                    <th>Deskripsi</th>
                    <th>Gambar / Sampul Event</th>
                    <th>Nama Panatia</th>
                    <th>No HP Panitia</th>
                    <th>Tanda Tanggan Panitia</th>
                    <th>Diinput Oleh</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1;
                foreach ($events as $event): ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= esc($event['nama_event']) ?></td>
                        <td><?= esc($event['tanggal_event']) ?></td>
                        <td><?= esc($event['lokasi']) ?></td>
                        <td><?= esc($event['deskripsi']) ?></td>
                        <td>
                            <?php if (!empty($event['gambar'])): ?>
                                <img src="<?= base_url('uploads/event/gambar/' . $event['gambar']) ?>" width="80" alt="Gambar Event">
                            <?php else: ?>
                                <span class="text-muted">Tidak ada gambar</span>
                            <?php endif; ?>
                        </td>
                        <td><?= esc($event['nama_panitia']) ?></td>
                        <td><?= esc($event['no_hp_panitia']) ?></td>
                        <td>
                            <?php if (!empty($event['ttd_panitia'])): ?>
                                <img src="<?= base_url('uploads/event/ttd/' . $event['ttd_panitia']) ?>" width="80" alt="Tanda Tangan Panitia">
                            <?php else: ?>
                                <span class="text-muted">Tidak ada tanda tangan</span>
                            <?php endif; ?>
                        </td>
                        <td><?= esc($event['username']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr>
                    <th>No</th>
                    <th>Nama Event</th>
                    <th>Tanggal Event</th>
                    <th>Lokasi</th>
                    <th>Deskripsi</th>
                    <th>Gambar / Sampul Event</th>
                    <th>Nama Panitia</th>
                    <th>No HP Panitia</th>
                    <th>Tanda Tanggan Panitia</th>
                    <th>Diinput Oleh</th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>

<?= $this->endSection() ?>
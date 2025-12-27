<?= $this->extend('layouts/admin') ?>

<?= $this->section('title') ?>
Dashboard
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="row">
    <!-- TOTAL EVENT -->
    <div class="col-lg-3 col-6">
        <div class="small-box bg-warning">
            <div class="inner">
                <h3><?= $total_event ?></h3>
                <p>Total Event</p>
            </div>
            <div class="icon"><i class="ion ion-calendar"></i></div>
            <a href="<?= base_url('admin/event') ?>" class="small-box-footer">
                Lihat Detail <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>

    <!-- TOTAL KATEGORI -->
    <div class="col-lg-3 col-6">
        <div class="small-box bg-danger">
            <div class="inner">
                <h3><?= $total_kategori ?></h3>
                <p>Total Kategori Event</p>
            </div>
            <div class="icon"><i class="ion ion-pricetag"></i></div>
            <a href="<?= base_url('admin/kategori-event') ?>" class="small-box-footer">
                Lihat Detail <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>

    <!-- TOTAL PESERTA -->
    <div class="col-lg-3 col-6">
        <div class="small-box bg-info">
            <div class="inner">
                <h3><?= $total_peserta ?></h3>
                <p>Total Peserta</p>
            </div>
            <div class="icon"><i class="ion ion-person-add"></i></div>
            <a href="<?= base_url('admin/pendaftar') ?>" class="small-box-footer">
                Lihat Detail <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>

    <!-- TOTAL TEMPLATE -->
    <div class="col-lg-3 col-6">
        <div class="small-box bg-primary">
            <div class="inner">
                <h3><?= $total_template ?></h3>
                <p>Total Template</p>
            </div>
            <div class="icon"><i class="ion ion-document"></i></div>
            <a href="<?= base_url('admin/template') ?>" class="small-box-footer">
                Lihat Detail <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>

    <!-- TOTAL SERTIFIKAT -->
    <div class="col-lg-3 col-6">
        <div class="small-box bg-secondary">
            <div class="inner">
                <h3><?= $total_sertifikat ?></h3>
                <p>Total Sertifikat</p>
            </div>
            <div class="icon"><i class="ion ion-document-text"></i></div>
            <a href="<?= base_url('admin/sertifikat') ?>" class="small-box-footer">
                Lihat Detail <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>

    <!-- 🔹 CARD BARU: DAFTAR EVENT YANG SUDAH DIBOOKING -->
    <div class="col-lg-3 col-6">
        <div class="small-box bg-success">
            <div class="inner">
                <h3><?= $total_tanggal_booking ?></h3>
                <p>Daftar Event yang Sudah Dibooking</p>
            </div>
            <div class="icon">
                <i class="ion ion-clock"></i>
            </div>
            <a href="<?= base_url('admin/booked-events') ?>" class="small-box-footer">
                Lihat Semua Event <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

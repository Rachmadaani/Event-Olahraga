<?= $this->extend('layouts/main') ?>

<?= $this->section('title') ?>
Beranda
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner" style="height: 80vh;">
        <div class="carousel-item active h-100">
            <img src="<?= base_url('img/carousel/1.png') ?>" class="d-block w-100 h-100 object-fit-cover" alt="Slide 1">
        </div>
        <div class="carousel-item h-100">
            <img src="<?= base_url('img/carousel/2.png') ?>" class="d-block w-100 h-100 object-fit-cover" alt="Slide 2">
        </div>
        <div class="carousel-item h-100">
            <img src="<?= base_url('img/carousel/3.png') ?>" class="d-block w-100 h-100 object-fit-cover" alt="Slide 2">
        </div>
        <div class="carousel-item h-100">
            <img src="<?= base_url('img/carousel/4.png') ?>" class="d-block w-100 h-100 object-fit-cover" alt="Slide 2">
        </div>
        <div class="carousel-item h-100">
            <img src="<?= base_url('img/carousel/5.png') ?>" class="d-block w-100 h-100 object-fit-cover" alt="Slide 2">
        </div>
        <div class="carousel-item h-100">
            <img src="<?= base_url('img/carousel/6.png') ?>" class="d-block w-100 h-100 object-fit-cover" alt="Slide 2">
        </div>
        <div class="carousel-item h-100">
            <img src="<?= base_url('img/carousel/7.png') ?>" class="d-block w-100 h-100 object-fit-cover" alt="Slide 2">
        </div>
        <div class="carousel-item h-100">
            <img src="<?= base_url('img/carousel/8.png') ?>" class="d-block w-100 h-100 object-fit-cover" alt="Slide 2">
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
        <span class="carousel-control-prev-icon"></span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
        <span class="carousel-control-next-icon"></span>
    </button>
</div>

<div class="container py-5">
    <h2 class="fw-bold mb-4 text-center">Daftar Event</h2>
    <form action="<?= base_url('event/search') ?>" method="get" class="d-flex justify-content-center mb-5">
        <div class="input-group w-50 shadow-sm">
            <input
                type="text"
                name="q"
                value="<?= esc($keyword ?? '') ?>"
                class="form-control form-control-lg"
                placeholder="Cari event..."
                aria-label="Cari event">
            <button class="btn btn-primary btn-lg px-4" type="submit">Cari</button>
        </div>
    </form>


    <?php
    $tz = new \DateTimeZone('Asia/Jakarta');
    $now = new \DateTime('now', $tz);

    $nearestEvent = null;
    $nearestEventDate = null;
    $minDiff = null;

    if (!empty($events) && is_array($events)) {
        foreach ($events as $ev) {
            $raw = trim($ev['tanggal_event'] ?? '');

            if (empty($raw)) continue;

            try {
                $evDate = new \DateTime($raw, $tz);
            } catch (\Exception $e) {
                $evDate = \DateTime::createFromFormat('Y-m-d', substr($raw, 0, 10), $tz);
                if (!$evDate) continue;
                $evDate->setTime(0, 0, 0);
            }

            if (preg_match('/^\d{4}-\d{2}-\d{2}$/', $raw)) {
                $evDate->setTime(0, 0, 0);
            }

            $diff = $evDate->getTimestamp() - $now->getTimestamp();
            if ($diff >= 0 && ($minDiff === null || $diff < $minDiff)) {
                $minDiff = $diff;
                $nearestEvent = $ev;
                $nearestEventDate = $evDate;
            }
        }
    }
    ?>

    <div class="text-center mb-5">
        <h4 class="fw-bold">
            <i class="fas fa-bullseye me-2 text-danger"></i>
            Event Terdekat:
            <?php if (!empty($nearestEvent)): ?>
                <a href="<?= site_url('login') ?>" class="text-decoration-none text-primary">
                    <?= esc($nearestEvent['nama_event']) ?>
                </a>
            <?php else: ?>
                <span class="text-muted">Belum ada event mendatang</span>
            <?php endif; ?>
        </h4>

        <div class="d-inline-block bg-light rounded-3 shadow-sm px-4 py-2 mt-2">
            <span id="countdown" class="fw-semibold fs-5 text-dark">
                <?php if (empty($nearestEvent)): ?>—<?php endif; ?>
            </span>
        </div>
    </div>

    <!-- card -->
    <?php
    $tz = new \DateTimeZone('Asia/Jakarta');
    $today = new \DateTime('now', $tz);
    $upcomingEvents = [];
    $pastEvents = [];
    if (!empty($events)) {
        foreach ($events as $ev) {
            $evDate = new \DateTime($ev['tanggal_event'], $tz);
            if ($evDate >= $today) {
                $upcomingEvents[] = $ev;
            } else {
                $pastEvents[] = $ev;
            }
        }
    }

    $bulanIndo = [
        1 => 'Januari',
        'Februari',
        'Maret',
        'April',
        'Mei',
        'Juni',
        'Juli',
        'Agustus',
        'September',
        'Oktober',
        'November',
        'Desember'
    ];
    ?>

    <!-- Event Mendatang -->
    <h3 class="fw-bold mb-4 text-center text-success">Event Mendatang</h3>
    <div class="row">
        <?php if (!empty($upcomingEvents)): ?>
            <?php foreach ($upcomingEvents as $ev): ?>
                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm border-0 h-100">
                        <img src="<?= base_url('uploads/event/gambar/' . $ev['gambar']) ?>"
                            class="card-img-top"
                            alt="<?= esc($ev['nama_event']) ?>"
                            style="height: 200px; object-fit: cover;">

                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title fw-bold mb-3 text-primary text-xl">
                                <?= esc($ev['nama_event']) ?>
                            </h5>
                            <?php
                            $tanggal = date('j', strtotime($ev['tanggal_event']));
                            $bulan = $bulanIndo[(int)date('n', strtotime($ev['tanggal_event']))];
                            $tahun = date('Y', strtotime($ev['tanggal_event']));
                            $tanggalIndo = $tanggal . ' ' . $bulan . ' ' . $tahun;
                            ?>
                            <p class="card-text mb-2">
                                <i class="fas fa-clock me-2 text-success"></i>
                                <?= $tanggalIndo ?>
                            </p>

                            <p class="card-text mb-3">
                                <i class="fas fa-map-marker-alt me-2 text-danger"></i>
                                <?= esc($ev['lokasi']) ?>
                            </p>
                            <a href="<?= site_url('login') ?>" class="btn btn-outline-primary mt-auto">
                                <i class="fas fa-pencil-alt me-1"></i> Daftar Event
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="col-12 text-center">
                <p>Belum ada event mendatang.</p>
            </div>
        <?php endif; ?>
    </div>

    <!-- Event Selesai -->
    <h3 class="fw-bold mb-4 mt-5 text-center text-danger">Event yang Sudah Selesai</h3>
    <div class="row">
        <?php if (!empty($pastEvents)): ?>
            <?php foreach ($pastEvents as $ev): ?>
                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm border-0 h-100">
                        <img src="<?= base_url('uploads/event/gambar/' . $ev['gambar']) ?>"
                            class="card-img-top"
                            alt="<?= esc($ev['nama_event']) ?>"
                            style="height: 200px; object-fit: cover; opacity: 0.6;">

                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title fw-bold mb-3 text-muted text-xl">
                                <?= esc($ev['nama_event']) ?>
                            </h5>
                            <?php
                            $tanggal = date('j', strtotime($ev['tanggal_event']));
                            $bulan = $bulanIndo[(int)date('n', strtotime($ev['tanggal_event']))];
                            $tahun = date('Y', strtotime($ev['tanggal_event']));
                            $tanggalIndo = $tanggal . ' ' . $bulan . ' ' . $tahun;
                            ?>
                            <p class="card-text mb-2 text-muted">
                                <i class="fas fa-clock me-2 text-secondary"></i>
                                <?= $tanggalIndo ?>
                            </p>

                            <p class="card-text mb-3 text-muted">
                                <i class="fas fa-map-marker-alt me-2 text-secondary"></i>
                                <?= esc($ev['lokasi']) ?>
                            </p>
                            <button class="btn btn-secondary mt-auto" disabled>
                                <i class="fas fa-check-circle me-1"></i> Event Selesai
                            </button>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="col-12 text-center">
                <p>Tidak ada event yang sudah selesai.</p>
            </div>
        <?php endif; ?>
    </div>

</div>

<script>
    const targetMs = <?= isset($nearestEventDate) ? ($nearestEventDate->getTimestamp() * 1000) : 'null' ?>;
    const countdownEl = document.getElementById("countdown");

    if (!targetMs) {
        countdownEl.innerHTML = 'Belum ada event mendatang';
    } else {
        const updateCountdown = () => {
            const now = Date.now();
            let distance = targetMs - now;

            if (distance <= 0) {
                countdownEl.innerHTML = 'Event sudah dimulai';
                clearInterval(intervalId);
                return;
            }

            const days = Math.floor(distance / (1000 * 60 * 60 * 24));
            const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((distance % (1000 * 60)) / 1000);

            countdownEl.innerHTML = `${days} Hari, ${hours} Jam, ${minutes} Menit, ${seconds} Detik`;
        };

        updateCountdown();
        const intervalId = setInterval(updateCountdown, 1000);
    }
</script>

<?= $this->endSection() ?>
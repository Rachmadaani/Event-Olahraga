<?= $this->extend('layouts/pengguna') ?>

<?= $this->section('title') ?>
Beranda
<?= $this->endSection() ?>

<?= $this->section('styles') ?>
<style>
    /* Reset margin dan padding untuk section */
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    /* Section Background */
    .event-section {
        background: linear-gradient(to bottom, #d8e9ff, #ffffff);
        padding: 70px 0;
    }

    /* Responsive padding untuk mobile */
    @media (max-width: 768px) {
        .event-section {
            padding: 30px 0 !important;
        }
    }

    @media (max-width: 576px) {
        .event-section {
            padding: 20px 0 !important;
        }
    }

    /* Container padding di mobile */
    @media (max-width: 576px) {
        .container {
            padding-left: 10px !important;
            padding-right: 10px !important;
        }
    }

    /* Event Grid */
    .event-container {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 25px;
        padding: 0;
        margin: 0;
        width: 100%;
    }

    @media (max-width: 768px) {
        .event-container {
            gap: 20px;
            padding: 0 5px;
        }
    }

    @media (max-width: 576px) {
        .event-container {
            gap: 15px;
            padding: 0;
        }
    }

    /* Event Card Styling */
    .event-card {
        width: 320px;
        background: #ffffff;
        border-radius: 18px;
        overflow: hidden;
        box-shadow: 0 6px 16px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
        border: 1px solid #e4e9f2;
        display: flex;
        flex-direction: column;
        text-decoration: none !important;
        color: inherit;
        cursor: pointer;
        position: relative;
        margin: 0;
    }

    /* PERBAIKAN: Mobile card tanpa margin horizontal */
    @media (max-width: 768px) {
        .event-card {
            width: calc(50% - 10px);
            max-width: none;
        }
    }

    @media (max-width: 576px) {
        .event-card {
            width: 100% !important;
            max-width: 100% !important;
            margin: 0 !important;
            border-radius: 15px;
        }
    }

    .event-card.clickable {
        cursor: pointer;
    }

    .event-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 10px 24px rgba(0, 0, 0, 0.15);
    }

    @media (max-width: 768px) {
        .event-card:hover {
            transform: translateY(-5px);
        }
    }

    /* PERBAIKAN: Gambar tidak terpotong */
    .event-card .card-img-container {
        height: 200px;
        width: 100%;
        overflow: hidden;
        position: relative;
        border-bottom: 3px solid #0d6efd;
    }

    @media (max-width: 768px) {
        .event-card .card-img-container {
            height: 180px;
        }
    }

    @media (max-width: 576px) {
        .event-card .card-img-container {
            height: 170px;
        }
    }

    .event-card .card-img-container img {
        width: 100%;
        height: 100%;
        object-fit: contain;
        object-position: center;
        background-color: #f8f9fa;
        transition: transform 0.3s ease;
    }

    .event-card:hover .card-img-container img {
        transform: scale(1.05);
    }

    .event-card .card-body {
        padding: 20px;
        flex: 1;
        display: flex;
        flex-direction: column;
    }

    @media (max-width: 768px) {
        .event-card .card-body {
            padding: 15px;
        }
    }

    @media (max-width: 576px) {
        .event-card .card-body {
            padding: 12px 15px;
        }
    }

    .event-card h5 {
        color: #0d6efd;
        font-weight: 700;
        font-size: 1.1rem;
        margin-bottom: 8px;
    }

    @media (max-width: 576px) {
        .event-card h5 {
            font-size: 1rem;
            margin-bottom: 6px;
        }
    }

    .event-card p {
        font-size: 0.95rem;
        margin-bottom: 6px;
        color: #555;
        line-height: 1.4;
    }

    @media (max-width: 576px) {
        .event-card p {
            font-size: 0.88rem;
            margin-bottom: 5px;
        }
    }

    /* Styling untuk link Google Maps */
    .google-maps-link-wrapper {
        margin-top: 8px;
    }

    .google-maps-link {
        font-size: 0.85rem;
        padding: 6px 12px;
        border-radius: 5px;
        background-color: #f8f9fa;
        border: 1px solid #dee2e6;
        transition: all 0.2s ease;
        display: inline-flex;
        align-items: center;
        gap: 5px;
        text-decoration: none !important;
        z-index: 10;
        position: relative;
    }

    @media (max-width: 576px) {
        .google-maps-link {
            font-size: 0.8rem;
            padding: 5px 10px;
        }
    }

    .google-maps-link:hover {
        background-color: #e9ecef;
        transform: scale(1.05);
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    .countdown-box {
        background: #ffffffd8;
        border: 2px solid #007bff2d;
        display: inline-block;
        border-radius: 12px;
        padding: 12px 24px;
        font-weight: 600;
        font-size: 1.05rem;
        color: #003366;
    }

    @media (max-width: 768px) {
        .countdown-box {
            padding: 10px 18px;
            font-size: 0.95rem;
            border-radius: 10px;
        }
    }

    @media (max-width: 576px) {
        .countdown-box {
            padding: 8px 15px;
            font-size: 0.9rem;
            margin: 10px auto;
            display: block;
            max-width: 90%;
        }
    }

    /* Fallback untuk gambar yang tidak ada */
    .event-card .card-img-container .no-image {
        width: 100%;
        height: 100%;
        background: linear-gradient(135deg, #0d6efd, #6c757d);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: 600;
        text-align: center;
        padding: 10px;
        font-size: 0.9rem;
    }

    /* Pointer events untuk konten yang tidak boleh mengarah ke pendaftaran */
    .google-maps-link-wrapper {
        pointer-events: auto;
    }

    .event-card.clickable *:not(.google-maps-link-wrapper) {
        pointer-events: none;
    }

    /* Hero Carousel Responsive */
    .carousel-inner {
        height: 100vh;
        overflow: hidden;
    }

    @media (max-width: 992px) {
        .carousel-inner {
            height: 70vh;
        }
    }

    @media (max-width: 768px) {
        .carousel-inner {
            height: 60vh;
            max-height: 400px;
        }
    }

    @media (max-width: 576px) {
        .carousel-inner {
            height: 45vh;
            max-height: 350px;
        }
    }

    .carousel-item {
        height: 100%;
    }

    .carousel-item img {
        object-fit: cover;
        width: 100%;
        height: 100%;
    }

    /* Hero Text Responsive - PERBAIKAN */
    .text-hero {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        text-align: center;
        color: white;
        width: 90%;
        padding: 0 15px;
    }

    .text-hero h1 {
        font-size: 3.5rem;
        font-weight: 700;
        margin-bottom: 20px;
        text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.5);
    }

    @media (max-width: 1200px) {
        .text-hero h1 {
            font-size: 3rem;
        }
    }

    @media (max-width: 992px) {
        .text-hero h1 {
            font-size: 2.5rem;
            margin-bottom: 15px;
        }

        .text-hero p {
            font-size: 1.1rem;
        }
    }

    @media (max-width: 768px) {
        .text-hero {
            width: 95% !important;
        }

        .text-hero h1 {
            font-size: 2rem;
            margin-bottom: 12px;
        }

        .text-hero p {
            font-size: 1rem;
            margin-bottom: 0;
        }
    }

    @media (max-width: 576px) {
        .text-hero {
            width: 100% !important;
            padding: 0 20px;
        }

        .text-hero h1 {
            font-size: 1.6rem !important;
            margin-bottom: 10px;
            line-height: 1.3;
        }

        .text-hero p {
            font-size: 0.9rem !important;
            margin-bottom: 0;
            line-height: 1.4;
        }
    }

    /* Search Form Responsive - PERBAIKAN */
    .input-group {
        width: 50% !important;
        margin: 0 auto;
    }

    @media (max-width: 992px) {
        .input-group {
            width: 70% !important;
        }
    }

    @media (max-width: 768px) {
        .input-group {
            width: 90% !important;
        }
    }

    @media (max-width: 576px) {
        .input-group {
            width: 100% !important;
            margin: 0;
        }

        .input-group .form-control-lg {
            font-size: 1rem !important;
            padding: 10px 15px !important;
            height: 45px;
        }

        .input-group .btn-lg {
            font-size: 1rem !important;
            padding: 10px 20px !important;
            height: 45px;
        }
    }

    /* Countdown Text Responsive */
    #countdown {
        font-size: 1.05rem;
        line-height: 1.4;
    }

    @media (max-width: 768px) {
        #countdown {
            font-size: 0.95rem;
        }
    }

    @media (max-width: 576px) {
        #countdown {
            font-size: 0.85rem;
            display: block;
        }
    }

    /* Event Title in Countdown */
    .countdown-box+div h4 {
        font-size: 1.25rem;
    }

    @media (max-width: 768px) {
        .countdown-box+div h4 {
            font-size: 1.1rem;
        }
    }

    @media (max-width: 576px) {
        .countdown-box+div h4 {
            font-size: 1rem;
            margin-bottom: 10px !important;
        }
    }

    /* Section Title */
    .event-section h2 {
        font-size: 2.5rem;
        margin-bottom: 30px !important;
    }

    @media (max-width: 768px) {
        .event-section h2 {
            font-size: 2rem;
            margin-bottom: 20px !important;
        }
    }

    @media (max-width: 576px) {
        .event-section h2 {
            font-size: 1.6rem !important;
            margin-bottom: 15px !important;
            padding: 0 10px;
        }
    }

    /* No events message */
    .text-center.w-100 {
        padding: 20px;
        width: 100%;
    }

    @media (max-width: 576px) {
        .text-center.w-100 {
            padding: 15px 10px;
        }
    }

    /* Carousel controls */
    .carousel-control-prev,
    .carousel-control-next {
        width: 40px;
        height: 40px;
        top: 50%;
        transform: translateY(-50%);
        background: rgba(0, 0, 0, 0.3);
        border-radius: 50%;
        margin: 0 10px;
    }

    @media (max-width: 576px) {

        .carousel-control-prev,
        .carousel-control-next {
            width: 35px;
            height: 35px;
        }
    }

    /* Hero overlay */
    .hero-overlay {
        background: linear-gradient(to bottom, rgba(0, 0, 0, 0.2), rgba(0, 0, 0, 0.5));
        z-index: 1;
    }
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<!-- HERO CAROUSEL -->
<div id="carouselHero" class="carousel slide position-relative" data-bs-ride="carousel" data-bs-interval="4000">
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="<?= base_url('img/carousel/1.png') ?>" class="d-block w-100" alt="Slide 1">
        </div>
        <div class="carousel-item">
            <img src="<?= base_url('img/carousel/2.png') ?>" class="d-block w-100" alt="Slide 2">
        </div>
        <div class="carousel-item">
            <img src="<?= base_url('img/carousel/3.png') ?>" class="d-block w-100" alt="Slide 3">
        </div>
        <div class="carousel-item">
            <img src="<?= base_url('img/carousel/4.png') ?>" class="d-block w-100" alt="Slide 4">
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselHero" data-bs-slide="prev">
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselHero" data-bs-slide="next">
        <span class="visually-hidden">Next</span>
    </button>

    <div class="text-hero">
        <h1 class="fw-bold mb-3">Selamat Datang di Event Olahraga</h1>
        <p class="lead">Daftarkan dirimu sekarang dan ikuti berbagai event olahraga seru bersama kami.</p>
    </div>
    <div class="hero-overlay"></div>
</div>

<!-- SECTION EVENT -->
<section class="event-section">
    <div class="container-fluid px-md-4 px-sm-3">
        <div class="row justify-content-center">
            <div class="col-12">
                <h2 class="fw-bold text-center text-primary mb-4">Daftar Event</h2>

                <!-- Form Pencarian -->
                <form action="<?= base_url('pengguna/event/search') ?>" method="get" class="d-flex justify-content-center mb-4">
                    <div class="input-group shadow-sm">
                        <input type="text" name="q" value="<?= esc($keyword ?? '') ?>" class="form-control form-control-lg"
                            placeholder="Cari event..." aria-label="Cari event">
                        <button class="btn btn-primary btn-lg px-4" type="submit">Cari</button>
                    </div>
                </form>

                <?php
                $tz = new \DateTimeZone('Asia/Jakarta');
                $now = new \DateTime('now', $tz);
                $nearestEvent = null;
                $nearestTime = null;
                if (!empty($events)) {
                    foreach ($events as $ev) {
                        if (!empty($ev['tanggal_event'])) {
                            try {
                                $eventDate = new \DateTime($ev['tanggal_event'], $tz);
                                if ($eventDate >= $now) {
                                    $diff = $eventDate->getTimestamp() - $now->getTimestamp();
                                    if ($nearestTime === null || $diff < $nearestTime) {
                                        $nearestTime = $diff;
                                        $nearestEvent = $ev;
                                    }
                                }
                            } catch (\Exception $e) {
                            }
                        }
                    }
                }
                ?>

                <!-- Countdown -->
                <div class="text-center mb-4 px-2">
                    <h4 class="fw-bold mb-3">
                        <i class="fas fa-stopwatch text-danger me-2"></i>
                        Event Terdekat:
                        <?php if ($nearestEvent): ?>
                            <a href="<?= base_url('pengguna/pendaftaran?event_id=' . $nearestEvent['id']) ?>"
                                class="text-decoration-none text-primary d-inline-block mt-1">
                                <?= esc($nearestEvent['nama_event']) ?>
                            </a>
                        <?php else: ?>
                            <span class="text-muted d-inline-block mt-1">Belum ada event mendatang</span>
                        <?php endif; ?>
                    </h4>
                    <div class="countdown-box d-inline-block">
                        <span id="countdown">Memuat waktu...</span>
                    </div>
                </div>

                <!-- Event Cards -->
                <div class="event-container">
                    <?php if (!empty($events)): ?>
                        <?php foreach ($events as $ev): ?>
                            <?php
                            // Alamat lengkap untuk ditampilkan
                            $addressParts = array_filter([$ev['kelurahan'] ?? '', $ev['kecamatan'] ?? '', $ev['kabupaten'] ?? '', $ev['provinsi'] ?? '']);
                            $fullAddress = implode(', ', $addressParts);

                            // Link Google Maps
                            $googleMapsLink = '';

                            if (!empty($ev['lokasi']) && filter_var($ev['lokasi'], FILTER_VALIDATE_URL)) {
                                $googleMapsLink = $ev['lokasi'];
                            } elseif (!empty($ev['latitude']) && !empty($ev['longitude'])) {
                                $googleMapsLink = "https://www.google.com/maps/search/?api=1&query={$ev['latitude']},{$ev['longitude']}";
                            } elseif (!empty($fullAddress)) {
                                $googleMapsLink = "https://www.google.com/maps/search/?api=1&query=" . urlencode($fullAddress);
                            } else {
                                $googleMapsLink = "#";
                            }

                            // Cek apakah gambar ada
                            $gambarPath = 'uploads/event/gambar/' . $ev['gambar'];
                            $gambarExists = !empty($ev['gambar']) && file_exists(FCPATH . $gambarPath);
                            ?>

                            <!-- Card dengan data attribute untuk event ID -->
                            <div class="event-card clickable"
                                data-event-id="<?= $ev['id'] ?>"
                                data-event-url="<?= base_url('pengguna/pendaftaran?event_id=' . $ev['id']) ?>">
                                <div class="card-img-container">
                                    <?php if ($gambarExists): ?>
                                        <img src="<?= base_url($gambarPath) ?>" alt="<?= esc($ev['nama_event']) ?>" loading="lazy">
                                    <?php else: ?>
                                        <div class="no-image">
                                            <i class="fas fa-calendar-alt fa-2x mb-2"></i>
                                            <br>
                                            <span><?= esc($ev['nama_event']) ?></span>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div class="card-body">
                                    <h5><?= esc($ev['nama_event']) ?></h5>
                                    <p><i class="fas fa-calendar-alt text-primary me-2"></i><?= date('d M Y', strtotime($ev['tanggal_event'])) ?></p>
                                    <p class="mb-1">
                                        <i class="fas fa-map-marker-alt text-danger me-2"></i>
                                        <span class="event-address"><?= esc($fullAddress) ?></span>
                                    </p>
                                    <?php if ($googleMapsLink !== '#'): ?>
                                        <div class="google-maps-link-wrapper">
                                            <a href="<?= $googleMapsLink ?>"
                                                target="_blank"
                                                class="text-decoration-none google-maps-link"
                                                onclick="event.stopPropagation()">
                                                <i class="fas fa-external-link-alt"></i>
                                                Buka di Google Maps
                                            </a>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="text-center w-100">
                            <p class="text-muted">Belum ada event tersedia.</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- COUNTDOWN SCRIPT -->
<script>
    const countdownEl = document.getElementById("countdown");
    const targetMs = <?= $nearestEvent ? strtotime($nearestEvent['tanggal_event']) * 1000 : 'null' ?>;

    if (!targetMs) {
        countdownEl.textContent = "Belum ada event mendatang";
    } else {
        const updateCountdown = () => {
            const now = Date.now();
            const distance = targetMs - now;
            if (distance <= 0) {
                countdownEl.textContent = "Event sudah dimulai";
                clearInterval(timer);
                return;
            }
            const days = Math.floor(distance / (1000 * 60 * 60 * 24));
            const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((distance % (1000 * 60)) / 1000);

            // Responsif untuk mobile
            if (window.innerWidth <= 576) {
                countdownEl.innerHTML = `${days} Hari ${hours} Jam<br>${minutes} Menit ${seconds} Detik`;
            } else {
                countdownEl.textContent = `${days} Hari, ${hours} Jam, ${minutes} Menit, ${seconds} Detik`;
            }
        };
        updateCountdown();
        const timer = setInterval(updateCountdown, 1000);

        // Update layout saat resize window
        window.addEventListener('resize', updateCountdown);
    }
</script>

<!-- SCRIPT UNTUK KLIK CARD -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Cek jika ada session login_success
        const loginSuccess = <?= session()->getFlashdata('login_success') ? 'true' : 'false' ?>;
        const userName = "<?= session()->get('name') ?? 'Pengguna' ?>";

        if (loginSuccess) {
            Swal.fire({
                title: `Selamat Datang, ${userName}!`,
                text: 'Anda berhasil login ke sistem Event Olahraga.',
                icon: 'success',
                confirmButtonColor: '#0d6efd',
                confirmButtonText: 'Lanjutkan',
                timer: 3000,
                timerProgressBar: true,
                didOpen: () => {
                    Swal.showLoading();
                }
            });
        }

        // Tangani klik pada card event
        document.querySelectorAll('.event-card.clickable').forEach(card => {
            card.addEventListener('click', function(e) {
                // Cek apakah yang diklik adalah link Google Maps
                if (e.target.closest('.google-maps-link-wrapper')) {
                    return; // Jangan lanjutkan jika yang diklik adalah link Google Maps
                }

                // Cek apakah yang diklik adalah link itu sendiri
                if (e.target.tagName === 'A' || e.target.closest('a')) {
                    // Biarkan link Google Maps berfungsi normal
                    if (e.target.classList.contains('google-maps-link') ||
                        e.target.closest('.google-maps-link')) {
                        return;
                    }
                }

                // Redirect ke halaman pendaftaran event
                const eventUrl = this.getAttribute('data-event-url');
                if (eventUrl) {
                    window.location.href = eventUrl;
                }
            });
        });

        // Tambahkan event listener untuk Google Maps links
        document.querySelectorAll('.google-maps-link').forEach(link => {
            link.addEventListener('click', function(e) {
                e.stopPropagation();
                // Buka di tab baru
                window.open(this.href, '_blank');
                return false;
            });
        });

        // Optimasi untuk mobile
        function optimizeForMobile() {
            if (window.innerWidth <= 576) {
                // Tambahkan padding horizontal untuk container
                const container = document.querySelector('.container-fluid');
                if (container) {
                    container.style.paddingLeft = '10px';
                    container.style.paddingRight = '10px';
                }

                // Pastikan card full width
                document.querySelectorAll('.event-card').forEach(card => {
                    card.style.margin = '0';
                    card.style.width = '100%';
                });
            }
        }

        optimizeForMobile();
        window.addEventListener('resize', optimizeForMobile);
    });
</script>

<?= $this->endSection() ?>
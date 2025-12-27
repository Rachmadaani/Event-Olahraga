<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $this->renderSection('title') ?> | Event Olahraga</title>
    <link rel="icon" type="image/png" href="<?= base_url('img/logo.png') ?>">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('assets/plugins/fontawesome-free/css/all.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/dist/css/adminlte.min.css') ?>">

    <style>
        /* Sticky Footer Solution - Minimal Changes */
        html,
        body {
            height: 100%;
        }

        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        main {
            flex: 1;
        }

        /* Footer styling - Original style preserved */
        footer {
            background-color: #f8f9fa;
            padding: 15px 0;
            text-align: center;
            border-top: 1px solid #e4e4e4;
            font-size: 0.9rem;
            color: #6c757d;
        }

        footer a {
            color: #6c757d;
            text-decoration: none;
        }

        footer a:hover {
            text-decoration: underline;
        }
    </style>

    <?= $this->renderSection('styles') ?>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="<?= base_url('/berandaLogin') ?>">
                <img src="<?= base_url('img/logo.png') ?>" alt="Logo" width="45" height="45"
                    class="d-inline-block align-text-middle">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-center" id="navbarSupportedContent">
                <ul class="navbar-nav mb-2 mb-lg-0 gap-lg-3">
                    <li class="nav-item">
                        <a class="nav-link fw-semibold <?= service('uri')->getPath() === '/berandaLogin' ? 'active' : '' ?>"
                            href="<?= base_url('pengguna/berandaLogin') ?>">Beranda</a>
                    </li>

                    <!-- Profil Saya -->
                    <li class="nav-item">
                        <a href="#" class="nav-link fw-semibold" data-bs-toggle="modal" data-bs-target="#profilModal">
                            Profil Saya
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link fw-semibold" href="<?= base_url('pengguna/pendaftaran') ?>">Pendaftaran</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link fw-semibold" href="<?= base_url('pengguna/riwayat') ?>">Riwayat</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link fw-semibold" href="<?= base_url('pengguna/daftarpeserta') ?>">Daftar Peserta</a>
                    </li>

                    <!-- Info -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle fw-semibold" href="#" id="infoDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Info
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="infoDropdown">
                            <li><a class="dropdown-item" href="#" data-bs-toggle="modal"
                                    data-bs-target="#tentangModal">Tentang</a></li>
                            <li><a class="dropdown-item" href="#" data-bs-toggle="modal"
                                    data-bs-target="#kontakModal">Kontak</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item text-danger" href="#" id="logoutBtn">
                                    <i class="fas fa-sign-out-alt me-2"></i>Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main>
        <?= $this->renderSection('content') ?>
    </main>

    <!-- Footer -->
    <footer>
        &copy; <?= date('Y') ?> <strong>Event Olahraga</strong>. All rights reserved.
    </footer>

    <!-- Modal Profil Saya -->
    <div class="modal fade" id="profilModal" tabindex="-1" aria-labelledby="profilModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="profilModalLabel">Profil Saya</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>

                <?php
                $nama = session()->get('name') ?: 'Nama tidak ditemukan';
                ?>

                <div class="modal-body text-center">
                    <i class="fas fa-user-circle fa-4x text-secondary mb-3"></i>
                    <h5 class="fw-bold mb-1"><?= esc($nama) ?></h5>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Tentang -->
    <div class="modal fade" id="tentangModal" tabindex="-1" aria-labelledby="tentangModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="tentangModalLabel">Tentang Kami</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p><strong>Event Olahraga</strong> adalah platform untuk pendaftaran dan manajemen event olahraga.</p>
                    <p>Kami mempermudah peserta mengikuti berbagai kegiatan olahraga dengan sistem digital modern.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Kontak -->
    <div class="modal fade" id="kontakModal" tabindex="-1" aria-labelledby="kontakModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title" id="kontakModalLabel">Kontak Kami</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <ul class="list-unstyled">
                        <li><i class="fas fa-envelope me-2 text-danger"></i> support@eventolahraga.com</li>
                        <li><i class="fas fa-phone me-2 text-primary"></i> +62 812-3456-7890</li>
                        <li><i class="fas fa-map-marker-alt me-2 text-warning"></i> Jakarta, Indonesia</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        function confirmLogout() {
            Swal.fire({
                title: 'Yakin ingin logout?',
                text: 'Kamu akan keluar dari akun ini.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, logout',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "<?= base_url('auth/logout') ?>";
                }
            });
        }

        document.getElementById('logoutBtn').addEventListener('click', confirmLogout);
    </script>

    <?= $this->renderSection('scripts') ?>
</body>

</html>
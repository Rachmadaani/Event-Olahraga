<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register | Event Olahraga</title>

    <link rel="icon" type="image/png" href="<?= base_url('img/logo.png') ?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <style>
        body {
            height: 100vh;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            background: url("<?= base_url('img/carousel/1.png') ?>") no-repeat center center/cover;
            position: relative;
            font-family: "Segoe UI", sans-serif;
        }

        body::before {
            content: "";
            position: absolute;
            inset: 0;
            background: rgba(0, 0, 0, 0.55);
            z-index: 0;
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.12);
            backdrop-filter: blur(14px);
            -webkit-backdrop-filter: blur(14px);
            border-radius: 1rem;
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.35);
            z-index: 1;
            color: #fff;
            padding: 2.2rem;
        }

        .register-title {
            font-weight: 700;
            font-size: 1.8rem;
            margin-bottom: 0.5rem;
        }

        .register-subtitle {
            font-size: 0.95rem;
            opacity: 0.85;
        }

        .input-group-custom {
            position: relative;
            margin-bottom: 1.2rem;
        }

        .input-group-custom .left-icon {
            position: absolute;
            top: 50%;
            left: 14px;
            transform: translateY(-50%);
            color: rgba(255, 255, 255, 0.8);
        }

        .input-group-custom .toggle-password {
            position: absolute;
            top: 50%;
            right: 14px;
            transform: translateY(-50%);
            color: rgba(255, 255, 255, 0.8);
            cursor: pointer;
        }

        .glass-input {
            width: 100%;
            padding: 0.75rem 2.5rem 0.75rem 2.5rem;
            border-radius: 0.5rem;
            background: rgba(255, 255, 255, 0.18);
            border: 1px solid rgba(255, 255, 255, 0.35);
            color: #fff;
            transition: all 0.3s ease;
        }

        .glass-input::placeholder {
            color: rgba(255, 255, 255, 0.7);
        }

        .glass-input:focus {
            background: rgba(255, 255, 255, 0.25);
            border-color: #6c757d;
            box-shadow: 0 0 10px rgba(108, 117, 125, 0.7);
            outline: none;
            color: #fff;
        }

        .btn-glass {
            background: rgba(108, 117, 125, 0.85);
            border: none;
            transition: all 0.3s;
            font-weight: 600;
            color: #fff;
        }

        .btn-glass:hover {
            background: rgba(108, 117, 125, 1);
            box-shadow: 0 0 14px rgba(108, 117, 125, 0.8);
        }

        @media (max-width: 576px) {
            .glass-card {
                padding: 2rem 1.5rem;
            }

            .register-title {
                font-size: 1.5rem;
            }
        }
    </style>
</head>

<body>
    <div class="position-absolute top-0 start-0 m-3 text-light">
        <a href="<?= base_url('/') ?>" class=" text-light small text-decoration-none justify-content-center d-flex align-items-center">
            <i class="fas fa-home me-1"></i> Beranda
        </a>
    </div>
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="col-md-6 col-lg-5">
            <div class="card glass-card">
                <div class="text-center mb-4">
                    <h2 class="register-title">Daftar Akun</h2>
                    <p class="register-subtitle">Isi data berikut untuk membuat akun</p>
                </div>
                <form action="<?= base_url('auth/registerAdmin/process') ?>" method="post">
                    <?= csrf_field() ?>
                    <div class="input-group-custom">
                        <i class="fas fa-id-card left-icon"></i>
                        <input type="text" class="form-control glass-input" name="name" placeholder="Nama Lengkap" required>
                    </div>
                    <div class="input-group-custom">
                        <i class="fas fa-user left-icon"></i>
                        <input type="text" class="form-control glass-input" name="username" placeholder="Username" required>
                    </div>
                    <div class="input-group-custom">
                        <i class="fas fa-envelope left-icon"></i>
                        <input type="email" class="form-control glass-input" name="email" placeholder="Email" required>
                    </div>
                    <div class="input-group-custom">
                        <i class="fas fa-lock left-icon"></i>
                        <input type="password" id="password" class="form-control glass-input" name="password" placeholder="Password" required>
                        <i class="fas fa-eye toggle-password" toggle="#password"></i>
                    </div>
                    <div class="input-group-custom">
                        <i class="fas fa-lock left-icon"></i>
                        <input type="password" id="confirm_password" class="form-control glass-input" name="confirm_password" placeholder="Konfirmasi Password" required>
                        <i class="fas fa-eye toggle-password" toggle="#confirm_password"></i>
                    </div>
                    <button type="submit" class="btn btn-glass w-100 py-2 mt-2">
                        Daftar
                    </button>
                </form>
                <div class="text-center mt-3">
                    <a href="<?= base_url('login') ?>" class="text-decoration-none text-light fw-semibold">
                        Sudah punya akun? <span class="text-decoration-underline">Login</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.querySelectorAll('.toggle-password').forEach(icon => {
            icon.addEventListener('click', function() {
                const input = document.querySelector(this.getAttribute('toggle'));
                if (input.type === "password") {
                    input.type = "text";
                    this.classList.remove("fa-eye");
                    this.classList.add("fa-eye-slash");
                } else {
                    input.type = "password";
                    this.classList.remove("fa-eye-slash");
                    this.classList.add("fa-eye");
                }
            });
        });
    </script>

    <?php if (session()->getFlashdata('success')): ?>
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: '<?= session()->getFlashdata('success') ?>',
                confirmButtonText: 'OK'
            });
        </script>
    <?php endif; ?>
    <?php if (session()->getFlashdata('error')): ?>
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: '<?= session()->getFlashdata('error') ?>',
                confirmButtonText: 'OK'
            });
        </script>
    <?php endif; ?>
    <?php if (isset($validation)): ?>
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Validasi Gagal',
                html: `<?= $validation->listErrors() ?>`,
                confirmButtonText: 'OK'
            });
        </script>
    <?php endif; ?>

</body>

</html>
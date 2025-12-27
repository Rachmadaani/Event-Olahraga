<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login | Event Olahraga</title>

    <link rel="icon" type="image/png" href="<?= base_url('img/logo.png') ?>">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
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
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border-radius: 1rem;
            border: 1px solid rgba(255, 255, 255, 0.25);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.4);
            z-index: 1;
            color: #fff;
            padding: 2.5rem;
        }

        .login-title {
            font-weight: 700;
            font-size: 1.8rem;
            margin-bottom: 0.5rem;
        }

        .login-subtitle {
            font-size: 0.95rem;
            opacity: 0.85;
        }

        .form-group {
            position: relative;
            margin-bottom: 1.5rem;
        }

        .form-group .left-icon {
            position: absolute;
            top: 50%;
            left: 15px;
            transform: translateY(-50%);
            color: rgba(255, 255, 255, 0.9);
            font-size: 1rem;
        }

        .form-group .toggle-password {
            position: absolute;
            top: 50%;
            right: 15px;
            transform: translateY(-50%);
            color: rgba(255, 255, 255, 0.8);
            font-size: 1rem;
            cursor: pointer;
        }

        .glass-input {
            width: 100%;
            padding: 0.75rem 2.5rem 0.75rem 2.5rem;
            border-radius: 0.5rem;
            background: rgba(255, 255, 255, 0.15);
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
            box-shadow: 0 0 10px rgba(108, 117, 125, 0.8);
            color: #fff;
            outline: none;
        }

        .btn-glass {
            background: rgba(108, 117, 125, 0.9);
            border: none;
            transition: all 0.3s;
            font-weight: 600;
            border-radius: 0.5rem;
        }

        .btn-glass:hover {
            background: rgba(108, 117, 125, 1);
            box-shadow: 0 0 12px rgba(108, 117, 125, 0.9);
        }

        .text-link {
            color: rgba(255, 255, 255, 0.9);
            transition: 0.3s;
        }

        .text-link:hover {
            color: #fff;
            text-decoration: underline;
        }

        @media (max-width: 576px) {
            .glass-card {
                padding: 2rem 1.5rem;
            }

            .login-title {
                font-size: 1.5rem;
            }
        }
    </style>
</head>

<body>
    <div class="position-absolute top-0 start-0 m-3 text-light">
        <a href="<?= base_url('/') ?>" class="text-light small text-decoration-none justify-content-center d-flex align-items-center">
            <i class="fas fa-home me-1"></i> Beranda
        </a>
    </div>
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="col-md-5 col-lg-4">
            <div class="card glass-card">
                <div class="text-center mb-4">
                    <h2 class="login-title">Login</h2>
                    <p class="login-subtitle">Silakan login untuk melanjutkan</p>
                </div>
                <form action="<?= base_url('auth/login/process') ?>" method="post">
                    <?= csrf_field() ?>
                    <div class="form-group">
                        <i class="fas fa-user left-icon"></i>
                        <input type="text" class="form-control glass-input" name="username" placeholder="Username" required>
                    </div>
                    <div class="form-group">
                        <i class="fas fa-lock left-icon"></i>
                        <input type="password" id="password" class="form-control glass-input" name="password" placeholder="Password" required>
                        <i class="fas fa-eye toggle-password" toggle="#password"></i>
                    </div>
                    <button type="submit" class="btn btn-glass w-100 py-2 text-white">
                        Masuk
                    </button>
                </form>
                <div class="text-center mt-3">
                    <a href="<?= base_url('auth/register') ?>" class="text-decoration-none text-link fw-semibold">
                        Belum punya akun? <span class="text-decoration-underline">Daftar</span>
                    </a>
                </div>
                <div class="text-center mt-2">
                    <a href="<?= base_url('auth/registerAdmin') ?>" class="text-decoration-none text-link fw-semibold">
                        Daftar sebagai <span class="text-decoration-underline ">Admin</span>
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

        <?php if (session()->getFlashdata('success')): ?>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: '<?= session()->getFlashdata('success') ?>',
                confirmButtonText: 'OK'
            });
        <?php endif; ?>

        <?php if (session()->getFlashdata('error')): ?>
            Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: '<?= session()->getFlashdata('error') ?>',
                confirmButtonText: 'OK'
            });
        <?php endif; ?>
    </script>



</body>

</html>
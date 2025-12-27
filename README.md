🏆 Event Olahraga – Sistem Manajemen Event Olahraga
Sebuah aplikasi berbasis web untuk mengelola event olahraga secara online, mulai dari pendaftaran peserta, penjadwalan, hingga hasil pertandingan.

📦 Fitur Utama
✅ Pendaftaran peserta online
✅ Penjadwalan event & pertandingan
✅ Manajemen kategori olahraga
✅ Dashboard admin & peserta
✅ Sertifikat digital peserta

🚀 Cara Mulai (Untuk Pemula)
# Clone Repository
bash
git clone https://github.com/Rachmadaani/Event-Olahraga.git
cd Event-Olahraga

# Install composer (jika belum ada)
command : composer install
command : composer update

# Install npm packages
command : npm install

# Setup Environment
bash
# Salin file environment
command : copy .env.example .env

# Generate key aplikasi
command : php artisan key:generate

# Setup Database
Buat database baru di MySQL/PostgreSQL

Update file .env dengan kredensial database:
env
DB_CONNECTION=mysql,
DB_HOST=127.0.0.1,
DB_PORT=3306,
DB_DATABASE=nama_database_anda,
DB_USERNAME=username_anda,
DB_PASSWORD=password_anda.

Jalankan migrasi database:

bash
php artisan migrate

# Generate asset frontend
command : npm run dev

# Jalankan server Codeigniter
command : php artisan serve
Buka browser dan akses: http://localhost:8000

📁 Struktur Proyek
text
Event-Olahraga/
app/              # Logic aplikasi (Models, Controllers),
database/         # Migrations, seeders,
resources/        # Views, assets, bahasa,
public/           # Asset publik (CSS, JS, images),
routes/           # Definisi rute web/API,
tests/            # Unit & feature tests.

👨‍💻 Default Login
Superadmin
Username: superadmin
Password: superadmin123

Admin
Username: admin@gmail.com
Password: password

Peserta
Username: rudi@gmail.com
Password: Rudi123

#Ganti password default setelah login pertama!#

🔧 Teknologi yang Digunakan
Backend: Codeigniter 4
Frontend: Bootstrap 5, JavaScript
Database: MySQL/PostgreSQL
Authentication: Auth CI

🧪 Testing
bash
# Jalankan unit test
command : php artisan test

# Jalankan test dengan coverage
php artisan test --coverage
🤝 Kontribusi
Fork repository ini

Buat branch baru (git checkout -b fitur-baru)

Commit perubahan (git commit -m 'Menambah fitur X')

Push ke branch (git push origin fitur-baru)

Buat Pull Request

📄 Lisensi
Proyek ini dilisensikan di bawah MIT License.

📞 Kontak & Dukungan
Developer: Rachmadaani

Repository: https://github.com/Rachmadaani/Event-Olahraga

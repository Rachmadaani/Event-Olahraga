-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 10 Des 2025 pada 06.02
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_event_olahraga`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `event`
--

CREATE TABLE `event` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `nama_event` varchar(255) NOT NULL,
  `tanggal_event` date NOT NULL,
  `provinsi` varchar(100) NOT NULL,
  `kabupaten` varchar(100) NOT NULL,
  `kecamatan` varchar(100) NOT NULL,
  `kelurahan` varchar(100) NOT NULL,
  `lokasi` varchar(255) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `nama_panitia` varchar(100) NOT NULL,
  `no_hp_panitia` varchar(20) NOT NULL,
  `ttd_panitia` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `event`
--

INSERT INTO `event` (`id`, `user_id`, `nama_event`, `tanggal_event`, `provinsi`, `kabupaten`, `kecamatan`, `kelurahan`, `lokasi`, `deskripsi`, `gambar`, `nama_panitia`, `no_hp_panitia`, `ttd_panitia`, `created_at`, `updated_at`) VALUES
(1, 2, 'Adidas Sport Running', '2026-05-10', 'DI YOGYAKARTA', 'KABUPATEN SLEMAN', 'PRAMBANAN', 'BOKO HARJO', 'https://maps.app.goo.gl/y7WuYXG7LSzBA4mU8', 'Event Lari yang di adakan oleh adidas', '1761554222_1e2bc68227a97874ee4a.png', 'Agung Hendrawan', '08893345267327', '1761554222_1047ec12c18f6339c32c.png', '2025-10-27 08:37:02', '2025-10-27 08:37:02'),
(2, 4, 'Nike Running Goes to Yogyakarta', '2026-05-03', 'DI YOGYAKARTA', 'KOTA YOGYAKARTA', 'KRATON', 'PATEHAN', 'https://maps.app.goo.gl/ZLavxBfP5MEAoCeW9', 'Event running yang diadakan di Yogyakarta', '1762069975_3a3ff62c9a55a3c55284.png', 'Wawan Guntur', '0887655688433', '1762069975_d558bfb65970c847c3f3.png', '2025-11-02 07:52:55', '2025-11-02 07:52:55');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori_event`
--

CREATE TABLE `kategori_event` (
  `id` int(11) UNSIGNED NOT NULL,
  `event_id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `nama_kategori` varchar(255) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `berbayar` enum('gratis','berbayar') NOT NULL DEFAULT 'gratis',
  `biaya` decimal(10,2) DEFAULT NULL,
  `rute` text DEFAULT NULL,
  `tanggal_mulai` date NOT NULL,
  `jam_mulai` time NOT NULL,
  `batas_waktu` datetime DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `kategori_event`
--

INSERT INTO `kategori_event` (`id`, `event_id`, `user_id`, `nama_kategori`, `deskripsi`, `berbayar`, `biaya`, `rute`, `tanggal_mulai`, `jam_mulai`, `batas_waktu`, `keterangan`, `created_at`, `updated_at`) VALUES
(1, 1, 3, 'Lari', 'E-Sertifikat, Konsumsi, WC, Medis', 'gratis', 0.00, '10K', '2026-05-10', '06:00:00', '2026-05-10 15:43:00', 'Waktu bisa berubah sesuai kondisi di tempat', '2025-10-27 08:44:40', '2025-10-27 08:44:40'),
(2, 2, 4, 'Lari', 'E-sertifikat, snack, medis', 'berbayar', 50000.00, '10K', '2026-05-03', '06:00:00', '2026-05-03 11:59:00', 'Waktu dapat berubah sesuai kondisi di lapangan', '2025-11-02 07:54:49', '2025-11-02 07:54:49');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(1, '2025-09-08-055447', 'App\\Database\\Migrations\\CreateUsersTable', 'default', 'App', 1761549447, 1),
(2, '2025-09-09-013055', 'App\\Database\\Migrations\\Event', 'default', 'App', 1761549448, 1),
(3, '2025-09-09-013104', 'App\\Database\\Migrations\\KategoriEvent', 'default', 'App', 1761549448, 1),
(4, '2025-09-09-035607', 'App\\Database\\Migrations\\PendaftaranEvent', 'default', 'App', 1761549449, 1),
(5, '2025-09-17-074625', 'App\\Database\\Migrations\\TemplateSertifikat', 'default', 'App', 1761549449, 1),
(6, '2025-09-17-092449', 'App\\Database\\Migrations\\CreateSertifikatPeserta', 'default', 'App', 1761549450, 1),
(7, '2025-10-22-104304', 'App\\Database\\Migrations\\AddEmailTerkirimToPendaftaranEvent', 'default', 'App', 1761549451, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pendaftaran_event`
--

CREATE TABLE `pendaftaran_event` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `event_id` int(11) UNSIGNED DEFAULT NULL,
  `kategori_event_id` int(11) UNSIGNED DEFAULT NULL,
  `admin_id` int(11) UNSIGNED DEFAULT NULL,
  `nama_lengkap` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `no_tlp` varchar(20) NOT NULL,
  `alamat_lengkap` text NOT NULL,
  `provinsi` varchar(100) NOT NULL,
  `kabupaten` varchar(100) NOT NULL,
  `kewarganegaraan` varchar(100) NOT NULL,
  `no_identitas` varchar(50) NOT NULL,
  `goldar` varchar(5) DEFAULT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `riwayat_penyakit` text DEFAULT NULL,
  `nama_kontak_darurat` varchar(255) DEFAULT NULL,
  `nohp_kontak_darurat` varchar(20) DEFAULT NULL,
  `hubungan_kontak_darurat` varchar(100) DEFAULT NULL,
  `rute` text DEFAULT NULL,
  `biaya` decimal(10,2) DEFAULT NULL,
  `ukuran_kaos` enum('S','M','L','XL','XXL') DEFAULT NULL,
  `persetujuan_peserta` tinyint(1) NOT NULL DEFAULT 0,
  `jumlah_pembayaran` decimal(10,2) DEFAULT NULL,
  `bukti_pembayaran` varchar(255) DEFAULT NULL,
  `status_pembayaran` enum('pending','lunas','gagal') NOT NULL DEFAULT 'pending',
  `email_terkirim` tinyint(1) DEFAULT 0,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pendaftaran_event`
--

INSERT INTO `pendaftaran_event` (`id`, `user_id`, `event_id`, `kategori_event_id`, `admin_id`, `nama_lengkap`, `email`, `no_tlp`, `alamat_lengkap`, `provinsi`, `kabupaten`, `kewarganegaraan`, `no_identitas`, `goldar`, `jenis_kelamin`, `tanggal_lahir`, `riwayat_penyakit`, `nama_kontak_darurat`, `nohp_kontak_darurat`, `hubungan_kontak_darurat`, `rute`, `biaya`, `ukuran_kaos`, `persetujuan_peserta`, `jumlah_pembayaran`, `bukti_pembayaran`, `status_pembayaran`, `email_terkirim`, `created_at`, `updated_at`) VALUES
(1, 3, 1, 1, 3, 'Rachmadaani Indrianto', 'rachmadaani.riskha@gmail.com', '08895228029', 'Piyungan Rt/Rw : 009/000, Srimartani, Piyungan, Bantul, Yogyakarta', 'DI YOGYAKARTA', 'KABUPATEN BANTUL', 'Indonesia', '3489294767299377892', 'AB+', 'Laki-laki', '2002-05-01', 'Tidak ada', 'Bambang', '08872324568845', 'Ayah', '10K', 0.00, 'M', 1, NULL, NULL, 'lunas', 1, '2025-10-27 09:32:30', '2025-10-27 09:34:50'),
(4, 3, 1, 1, 3, 'Rachmadaani Indrianto', 'rachmadaani.riskha@gmail.com', '08895228029', 'Piyungan Rt/Rw : 009/000, Srimartani, Piyungan, Bantul, Yogyakarta', 'DI YOGYAKARTA', 'KABUPATEN BANTUL', 'Indonesia', '3489294767299376489', 'AB+', 'Laki-laki', '2002-05-01', 'Tidak ada', 'Bela', '0887632234623', 'Teman', '10K', 0.00, 'M', 1, NULL, NULL, 'lunas', 1, '2025-10-27 14:05:56', '2025-11-01 11:45:37'),
(5, 3, 2, 2, 3, 'Rachmadaani Indrianto', 'rachmadaani.riskha@gmail.com', '08895228029', 'Piyungan Rt/Rw : 009/000, Srimartani, Piyungan, Bantul, Yogyakarta', 'DI YOGYAKARTA', 'KABUPATEN BANTUL', 'Indonesia', '3489294767299376489', 'AB+', 'Laki-laki', '2002-05-01', 'Tidak ada', 'Hartono', '08864545448934', 'Saudara', '10K', 50000.00, 'M', 1, 50000.00, '1762071236_3b20d46324da0d3457c6.jpeg', 'lunas', 1, '2025-11-02 08:12:32', '2025-11-02 08:16:26'),
(7, 3, 2, 2, 3, 'Rachmadaani Indrianto', 'rachmadaani.riskha@gmail.com', '08236764282', 'Jalan Piyungan', 'DI YOGYAKARTA', 'KABUPATEN SLEMAN', 'Indonesia', '245623539323415', 'A+', 'Laki-laki', '2002-05-01', 'Tidak ada', 'Dani', '08236764282', 'Teman', '10K', 50000.00, 'L', 1, 50000.00, '1762344633_6fc3f413cc66399cafa4.png', 'lunas', 1, '2025-11-05 12:09:51', '2025-11-05 12:12:14'),
(8, 3, 2, 2, 3, 'Rachmadaani Indrianto', 'rachmadaani.riskha@gmail.com', '087632753232', 'jln merpati', 'DI YOGYAKARTA', 'KABUPATEN BANTUL', 'Indonesia', '368286096860699261', 'A+', 'Laki-laki', '2002-05-01', 'Tidak ada', 'Wawan', '087632753232', 'Teman', '10K', 50000.00, 'L', 1, 50000.00, '1763556214_89204bf93a02b2628431.png', 'lunas', 0, '2025-11-19 12:41:48', '2025-11-19 12:46:05'),
(9, 3, 1, 1, 3, 'Rachmadaani Indrianto', 'rachmadaani.riskha@gmail.com', '087632753232', 'jln merpati', 'DI YOGYAKARTA', 'KABUPATEN BANTUL', 'Indonesia', '368286096860699261', 'AB+', 'Laki-laki', '2002-05-01', 'Tidak ada', 'Wawan', '087632753232', 'Teman', '10K', 0.00, 'L', 1, NULL, NULL, 'pending', 0, '2025-11-19 13:36:58', '2025-11-19 13:37:51'),
(10, 2, NULL, NULL, NULL, 'Admin Adidas', 'Adidas@gmail.com', '087632753232', 'jln merpati', 'DI YOGYAKARTA', 'KABUPATEN BANTUL', 'Indonesia', '368286096860699261', 'AB+', 'Laki-laki', '2025-11-05', 'Tidak ada', 'Wawan', '087632753232', 'Teman', NULL, NULL, NULL, 0, NULL, NULL, 'pending', 0, '2025-11-19 13:48:07', '2025-11-19 13:48:07'),
(11, 5, 2, 2, 5, 'Rudysta Triwibowo', 'rudysta@gmail.com', '087632753232', 'jln merpati', 'DI YOGYAKARTA', 'KABUPATEN GUNUNG KIDUL', 'Indonesia', '368286096860699261', 'AB-', 'Laki-laki', '2003-10-10', 'Tidak ada', 'Wawan', '087632753232', 'Teman', '10K', 50000.00, 'L', 1, 50000.00, '1763563558_07a1034acc925e42a232.png', 'pending', 0, '2025-11-19 14:44:56', '2025-11-19 14:45:58'),
(12, 3, 1, 1, 3, 'Rachmadaani Indrianto', 'rachmadaani.riskha@gmail.com', '087632753232', 'jln merpati', 'DI YOGYAKARTA', 'KABUPATEN BANTUL', 'Indonesia', '368286096860699261', 'B+', 'Laki-laki', '2002-05-01', 'Tidak ada', 'Wawan', '087632753232', 'Teman', '10K', 0.00, 'L', 1, NULL, NULL, 'pending', 0, '2025-11-21 05:02:30', '2025-11-21 05:18:17'),
(13, 3, 2, 2, 3, 'Rachmadaani Indrianto', 'rachmadaani.riskha@gmail.com', '087632753232', 'jln merpati', 'DI YOGYAKARTA', 'KABUPATEN BANTUL', 'Indonesia', '368286096860699261', 'AB+', 'Laki-laki', '2002-05-01', 'Tidak ada', 'Wawan', '087632753232', 'Teman', '10K', 50000.00, 'L', 1, 50000.00, '1763702915_f110cada7872db63dff4.png', 'pending', 0, '2025-11-21 05:20:03', '2025-11-21 05:28:36');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sertifikat_peserta`
--

CREATE TABLE `sertifikat_peserta` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `pendaftaran_id` int(11) UNSIGNED NOT NULL,
  `template_id` int(11) UNSIGNED NOT NULL,
  `nomor_sertifikat` varchar(100) DEFAULT NULL,
  `file_sertifikat` varchar(255) DEFAULT NULL,
  `dibuat_pada` datetime DEFAULT NULL,
  `diperbarui_pada` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `sertifikat_peserta`
--

INSERT INTO `sertifikat_peserta` (`id`, `user_id`, `pendaftaran_id`, `template_id`, `nomor_sertifikat`, `file_sertifikat`, `dibuat_pada`, `diperbarui_pada`) VALUES
(1, 2, 1, 1, 'PS001', NULL, '2025-11-01 11:47:40', '2025-11-01 11:47:40'),
(2, 4, 5, 2, 'PS001', NULL, '2025-11-02 08:17:06', '2025-11-02 08:17:06');

-- --------------------------------------------------------

--
-- Struktur dari tabel `template_sertifikat`
--

CREATE TABLE `template_sertifikat` (
  `id` int(11) UNSIGNED NOT NULL,
  `nama_template` varchar(255) NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `template_sertifikat`
--

INSERT INTO `template_sertifikat` (`id`, `nama_template`, `gambar`, `created_at`, `updated_at`) VALUES
(1, 'Adidas Sport Running', '1761997608_5f6665fd82683352e923.png', '2025-11-01 11:46:48', '2025-11-01 11:46:48'),
(2, 'Nike Running', '1762070351_915ccfc998e964702a2d.png', '2025-11-02 07:56:42', '2025-11-02 07:59:12');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('superadmin','admin','pengguna') NOT NULL DEFAULT 'pengguna',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `password`, `role`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', 'superadmin', 'superadmin@example.com', '$2y$10$ZGnNjAX25QfKHy5WAxeBcev2QpjZtYZ833Z/2t97GgGpCP5k9tRAO', 'superadmin', '2025-10-27 07:20:25', '2025-10-27 07:20:25'),
(2, 'Admin Adidas', 'Adminadidas', 'Adidas@gmail.com', '$2y$10$zM9rKjvFgRlJFaFVpVI1Z.6YH6xuCrMEU4dqbrqBDin/5w8LI0WJO', 'admin', '2025-10-27 07:22:53', '2025-10-27 07:22:53'),
(3, 'Rachmadaani Indrianto', 'rachmadaani', 'rachmadaani.riskha@gmail.com', '$2y$10$TS4qZyNfSsFFVF.d0Pb8z.XqlNYucOdIYJGEQ7guS0kVCOyhfjv72', 'pengguna', '2025-10-27 07:24:54', '2025-10-27 07:24:54'),
(4, 'Admin Nike', 'Admin Nike', 'Nike@gmail.com', '$2y$10$LfUdLSHgt9dIFYOgJWyLsOUL0N4Mi5C9XFrMsF3pU8VupkWh4VQcS', 'admin', '2025-10-27 09:43:59', '2025-10-27 09:43:59'),
(5, 'Rudysta Triwibowo', 'Rudi', 'rudysta@gmail.com', '$2y$10$.vkMknPSRyNL3MSgaRqhQu/0EaLcG812i7UKqbs5k7bOm92tgneaq', 'pengguna', '2025-10-28 06:45:45', '2025-10-28 06:45:45');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`id`),
  ADD KEY `event_user_id_foreign` (`user_id`);

--
-- Indeks untuk tabel `kategori_event`
--
ALTER TABLE `kategori_event`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kategori_event_event_id_foreign` (`event_id`),
  ADD KEY `kategori_event_user_id_foreign` (`user_id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pendaftaran_event`
--
ALTER TABLE `pendaftaran_event`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pendaftaran_event_user_id_foreign` (`user_id`),
  ADD KEY `pendaftaran_event_event_id_foreign` (`event_id`),
  ADD KEY `pendaftaran_event_kategori_event_id_foreign` (`kategori_event_id`),
  ADD KEY `pendaftaran_event_admin_id_foreign` (`admin_id`);

--
-- Indeks untuk tabel `sertifikat_peserta`
--
ALTER TABLE `sertifikat_peserta`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sertifikat_peserta_pendaftaran_id_foreign` (`pendaftaran_id`),
  ADD KEY `sertifikat_peserta_template_id_foreign` (`template_id`);

--
-- Indeks untuk tabel `template_sertifikat`
--
ALTER TABLE `template_sertifikat`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `event`
--
ALTER TABLE `event`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `kategori_event`
--
ALTER TABLE `kategori_event`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `pendaftaran_event`
--
ALTER TABLE `pendaftaran_event`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `sertifikat_peserta`
--
ALTER TABLE `sertifikat_peserta`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `template_sertifikat`
--
ALTER TABLE `template_sertifikat`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `event`
--
ALTER TABLE `event`
  ADD CONSTRAINT `event_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `kategori_event`
--
ALTER TABLE `kategori_event`
  ADD CONSTRAINT `kategori_event_event_id_foreign` FOREIGN KEY (`event_id`) REFERENCES `event` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `kategori_event_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `pendaftaran_event`
--
ALTER TABLE `pendaftaran_event`
  ADD CONSTRAINT `pendaftaran_event_admin_id_foreign` FOREIGN KEY (`admin_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `pendaftaran_event_event_id_foreign` FOREIGN KEY (`event_id`) REFERENCES `event` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `pendaftaran_event_kategori_event_id_foreign` FOREIGN KEY (`kategori_event_id`) REFERENCES `kategori_event` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `pendaftaran_event_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `sertifikat_peserta`
--
ALTER TABLE `sertifikat_peserta`
  ADD CONSTRAINT `sertifikat_peserta_pendaftaran_id_foreign` FOREIGN KEY (`pendaftaran_id`) REFERENCES `pendaftaran_event` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sertifikat_peserta_template_id_foreign` FOREIGN KEY (`template_id`) REFERENCES `template_sertifikat` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

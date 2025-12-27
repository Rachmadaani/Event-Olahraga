<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\EventModel;
use App\Models\KategoriEventModel;
use App\Models\PendaftaranEventModel;
use App\Models\SertifikatPesertaModel;
use App\Models\TemplateModel;

class DashboardController extends BaseController
{
    public function index()
    {
        $session = session();
        $userId = $session->get('id');

        if (!$userId) {
            return redirect()->to('/login')->with('error', 'Sesi login berakhir. Silakan login kembali.');
        }

        $eventModel        = new EventModel();
        $kategoriEventModel = new KategoriEventModel();
        $pendaftaranModel  = new PendaftaranEventModel();
        $templateModel     = new TemplateModel();
        $sertifikatModel   = new SertifikatPesertaModel();

        // 🔸 Total event milik admin login
        $totalEvent = $eventModel->where('user_id', $userId)->countAllResults();

        // 🔸 Total kategori event yang dibuat admin login
        $totalKategori = $kategoriEventModel
            ->join('event', 'event.id = kategori_event.event_id', 'left')
            ->where('event.user_id', $userId)
            ->countAllResults();

        // 🔸 Total peserta di event admin login
        $totalPeserta = $pendaftaranModel
            ->join('event', 'event.id = pendaftaran_event.event_id', 'left')
            ->where('event.user_id', $userId)
            ->countAllResults();

        // 🔸 Total template — tetap privat milik admin login
        $db = \Config\Database::connect();
        $totalTemplate = $db->table('template_sertifikat t')
            ->join('sertifikat_peserta sp', 'sp.template_id = t.id', 'left')
            ->join('pendaftaran_event pe', 'pe.id = sp.pendaftaran_id', 'left')
            ->join('event e', 'e.id = pe.event_id', 'left')
            ->groupStart()
                ->where('e.user_id', $userId)
                ->orWhere('e.user_id IS NULL')
            ->groupEnd()
            ->countAllResults();

        // 🔸 Total sertifikat — tetap milik admin login
        $totalSertifikat = $sertifikatModel
            ->join('pendaftaran_event', 'pendaftaran_event.id = sertifikat_peserta.pendaftaran_id', 'left')
            ->join('event', 'event.id = pendaftaran_event.event_id', 'left')
            ->where('event.user_id', $userId)
            ->countAllResults();

        // 🔸 Ambil SEMUA event yang sudah dibooking (bisa dilihat semua admin)
        $bookedDates = $eventModel
            ->select('tanggal_event, nama_event, provinsi, kabupaten, kecamatan, kelurahan, lokasi, nama_panitia, user_id')
            ->where('tanggal_event IS NOT NULL')
            ->orderBy('tanggal_event', 'ASC')
            ->findAll();

        // 🔸 Hitung semua tanggal unik dari semua admin
        $totalTanggalBooking = count(array_unique(array_column($bookedDates, 'tanggal_event')));

        // 🔸 Kirim data ke view
        $data = [
            'total_event'           => $totalEvent,
            'total_kategori'        => $totalKategori,
            'total_peserta'         => $totalPeserta,
            'total_template'        => $totalTemplate,
            'total_sertifikat'      => $totalSertifikat,
            'total_tanggal_booking' => $totalTanggalBooking,
            'booked_dates'          => $bookedDates,
        ];

        return view('admin/dashboard', $data);
    }

    // 🔹 Semua admin bisa lihat daftar event yang sudah dibooking
    public function bookedEvents()
    {
        $session = session();
        $userId = $session->get('id');

        if (!$userId) {
            return redirect()->to('/login')->with('error', 'Sesi login berakhir. Silakan login kembali.');
        }

        $eventModel = new EventModel();

        // ✅ Ambil semua event tanpa filter user_id agar semua admin bisa melihat
        $events = $eventModel
            ->select('nama_event, tanggal_event, provinsi, kabupaten, kecamatan, kelurahan, lokasi, nama_panitia')
            ->where('tanggal_event IS NOT NULL')
            ->orderBy('tanggal_event', 'ASC')
            ->findAll();

        return view('admin/booked-events', ['events' => $events]);
    }
}

<?php

namespace App\Controllers\Pengguna;

use App\Controllers\BaseController;
use App\Models\PendaftaranEventModel;
use App\Models\SertifikatPesertaModel;

class DaftarPesertaController extends BaseController
{
    protected $pendaftaranModel;
    protected $sertifikatModel;

    public function __construct()
    {
        $this->pendaftaranModel = new PendaftaranEventModel();
        $this->sertifikatModel  = new SertifikatPesertaModel();
    }

    public function index()
    {
        $userId = session()->get('id');

        if (!$userId) {
            return redirect()->to(base_url('login'))->with('error', 'Silakan login terlebih dahulu.');
        }

        $peserta = $this->pendaftaranModel
            ->select('
                pendaftaran_event.*,
                event.nama_event,
                event.tanggal_event,
                kategori_event.nama_kategori,
                sertifikat_peserta.id AS sertifikat_id
            ')
            ->join('event', 'event.id = pendaftaran_event.event_id', 'left')
            ->join('kategori_event', 'kategori_event.id = pendaftaran_event.kategori_event_id', 'left')
            ->join('sertifikat_peserta', 'sertifikat_peserta.pendaftaran_id = pendaftaran_event.id', 'left')
            ->where('pendaftaran_event.user_id', $userId)
            ->orderBy('pendaftaran_event.created_at', 'DESC')
            ->findAll();

        return view('pengguna/daftar_peserta', [
            'peserta' => $peserta,
        ]);
    }

    public function previewSertifikat($id)
    {
        $userId = session()->get('id');

        $sertifikat = $this->sertifikatModel
            ->select('
                sertifikat_peserta.*,
                pendaftaran_event.user_id,
                pendaftaran_event.nama_lengkap AS nama_peserta,
                event.nama_event,
                event.lokasi,
                event.tanggal_event,
                event.nama_panitia,
                event.ttd_panitia,
                event.provinsi,
                event.kabupaten,
                event.kecamatan,
                event.kelurahan,
                template_sertifikat.gambar AS background_img
            ')
            ->join('pendaftaran_event', 'pendaftaran_event.id = sertifikat_peserta.pendaftaran_id')
            ->join('event', 'event.id = pendaftaran_event.event_id')
            ->join('template_sertifikat', 'template_sertifikat.id = sertifikat_peserta.template_id', 'left')
            ->where('sertifikat_peserta.id', $id)
            ->where('pendaftaran_event.user_id', $userId)
            ->first();

        if (!$sertifikat) {
            return redirect()->back()->with('error', 'Sertifikat tidak ditemukan atau bukan milik Anda.');
        }

        $sertifikat['background_url'] = base_url('uploads/templates/' . $sertifikat['background_img']);
        $sertifikat['ttd_url'] = $sertifikat['ttd_panitia']
            ? base_url('uploads/event/ttd/' . $sertifikat['ttd_panitia'])
            : null;

        // Format tanggal Indonesia
        $sertifikat['tanggal_indonesia'] = $this->formatTanggalIndonesia($sertifikat['tanggal_event']);

        return view('pengguna/sertifikat_preview', [
            'sertifikat' => $sertifikat
        ]);
    }

    /**
     * Format tanggal ke bahasa Indonesia
     */
    private function formatTanggalIndonesia($tanggal)
    {
        $bulan = [
            'January' => 'Januari',
            'February' => 'Februari',
            'March' => 'Maret',
            'April' => 'April',
            'May' => 'Mei',
            'June' => 'Juni',
            'July' => 'Juli',
            'August' => 'Agustus',
            'September' => 'September',
            'October' => 'Oktober',
            'November' => 'November',
            'December' => 'Desember'
        ];

        $englishDate = date('d F Y', strtotime($tanggal));
        $indonesianDate = $englishDate;

        foreach ($bulan as $en => $id) {
            $indonesianDate = str_replace($en, $id, $indonesianDate);
        }

        return $indonesianDate;
    }
}

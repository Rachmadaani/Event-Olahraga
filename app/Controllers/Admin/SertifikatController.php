<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\PendaftaranEventModel;
use App\Models\SertifikatPesertaModel;
use App\Models\TemplateModel;

class SertifikatController extends BaseController
{
    protected $sertifikatModel;
    protected $pendaftarModel;
    protected $templateModel;

    public function __construct()
    {
        $this->sertifikatModel = new SertifikatPesertaModel();
        $this->pendaftarModel  = new PendaftaranEventModel();
        $this->templateModel   = new TemplateModel();
    }

    public function index()
    {
        $userId = session()->get('id'); // id admin login

        $data = [
            // 🔒 hanya ambil sertifikat yang dibuat oleh admin login
            'sertifikat' => $this->sertifikatModel
                ->select('sertifikat_peserta.*, pendaftaran_event.nama_lengkap as nama_peserta, event.nama_event, template_sertifikat.nama_template')
                ->join('pendaftaran_event', 'pendaftaran_event.id = sertifikat_peserta.pendaftaran_id')
                ->join('event', 'event.id = pendaftaran_event.event_id')
                ->join('template_sertifikat', 'template_sertifikat.id = sertifikat_peserta.template_id')
                ->where('sertifikat_peserta.user_id', $userId)
                ->orderBy('sertifikat_peserta.nomor_sertifikat', 'ASC')
                ->findAll(),

            // 🔒 ambil pendaftar hanya untuk event yang dimiliki admin login
            'pendaftar' => $this->pendaftarModel
                ->select('
                    pendaftaran_event.*,
                    event.nama_event,
                    kategori_event.nama_kategori,
                    event.tanggal_event
                ')
                ->join('event', 'event.id = pendaftaran_event.event_id')
                ->join('kategori_event', 'kategori_event.id = pendaftaran_event.kategori_event_id', 'left')
                ->where('event.user_id', $userId)
                ->orderBy('pendaftaran_event.nama_lengkap', 'ASC')
                ->findAll(),

            // 🔒 hanya tampilkan template yang tidak digunakan oleh admin lain
            'templates' => $this->getTemplatesByAdmin($userId),
        ];

        return view('admin/sertifikat', $data);
    }

    private function getTemplatesByAdmin($userId)
    {
        $db = \Config\Database::connect();

        // ambil id template yang digunakan oleh admin login
        $usedByAdmin = $db->table('sertifikat_peserta')
            ->select('template_id')
            ->where('user_id', $userId)
            ->groupBy('template_id')
            ->get()
            ->getResultArray();

        $ids = array_column($usedByAdmin, 'template_id');

        if (empty($ids)) {
            // belum ada template digunakan → tampilkan semua
            return $db->table('template_sertifikat')
                ->orderBy('created_at', 'DESC')
                ->get()
                ->getResultArray();
        }

        // tampilkan template yang belum digunakan oleh admin lain atau milik sendiri
        return $db->table('template_sertifikat t')
            ->whereNotIn('id', function ($builder) use ($userId) {
                $builder->select('template_id')
                    ->from('sertifikat_peserta')
                    ->join('pendaftaran_event', 'pendaftaran_event.id = sertifikat_peserta.pendaftaran_id')
                    ->join('event', 'event.id = pendaftaran_event.event_id')
                    ->where('event.user_id !=', $userId);
            })
            ->orderBy('created_at', 'DESC')
            ->get()
            ->getResultArray();
    }

    public function store()
    {
        $userId = session()->get('id');
        
        // Cek apakah peserta sudah memiliki sertifikat untuk event ini
        $pendaftaranId = $this->request->getPost('pendaftar_id');
        $existingCertificate = $this->sertifikatModel
            ->where('pendaftaran_id', $pendaftaranId)
            ->where('user_id', $userId)
            ->first();
        
        if ($existingCertificate) {
            return redirect()->back()->with('error', 'Peserta ini sudah memiliki sertifikat untuk event ini.');
        }
        
        // Generate nomor sertifikat otomatis
        $nextNumber = $this->getNextCertificateNumber($userId);
        
        if (!$nextNumber) {
            return redirect()->back()->with('error', 'Tidak dapat membuat sertifikat. Nomor sertifikat sudah mencapai batas maksimum (P99999).');
        }

        $data = [
            'user_id'          => $userId,
            'pendaftaran_id'   => $pendaftaranId,
            'template_id'      => $this->request->getPost('template_id'),
            'nomor_sertifikat' => $nextNumber,
            'dibuat_pada'      => date('Y-m-d H:i:s')
        ];

        if ($this->sertifikatModel->insert($data)) {
            return redirect()->back()->with('success', 'Sertifikat berhasil dibuat dengan nomor: ' . $nextNumber);
        }

        return redirect()->back()->with('error', 'Gagal membuat sertifikat.');
    }

    /**
     * Mendapatkan nomor sertifikat berikutnya secara otomatis
     * Format: P00001 - P99999
     */
    private function getNextCertificateNumber($userId)
    {
        // Ambil semua nomor sertifikat yang sudah digunakan oleh admin ini
        $usedNumbers = $this->sertifikatModel
            ->select('nomor_sertifikat')
            ->where('user_id', $userId)
            ->orderBy('nomor_sertifikat', 'ASC')
            ->findAll();
        
        $usedNumbers = array_column($usedNumbers, 'nomor_sertifikat');
        
        // Jika belum ada sertifikat, mulai dari P00001
        if (empty($usedNumbers)) {
            return 'P00001';
        }
        
        // Ekstrak angka dari nomor terakhir
        $lastNumber = end($usedNumbers);
        $lastNumberStr = substr($lastNumber, 1); // Hilangkan 'P'
        $lastNumberInt = (int)$lastNumberStr;
        
        // Cari nomor berikutnya yang belum digunakan
        for ($i = $lastNumberInt + 1; $i <= 99999; $i++) {
            $candidate = 'P' . str_pad($i, 5, '0', STR_PAD_LEFT);
            
            // Cek apakah nomor ini sudah digunakan
            if (!in_array($candidate, $usedNumbers)) {
                return $candidate;
            }
        }
        
        // Jika sudah mencapai P99999, cari celah nomor yang belum digunakan
        for ($i = 1; $i <= 99999; $i++) {
            $candidate = 'P' . str_pad($i, 5, '0', STR_PAD_LEFT);
            
            if (!in_array($candidate, $usedNumbers)) {
                return $candidate;
            }
        }
        
        // Semua nomor sudah digunakan
        return false;
    }

    public function delete($id)
    {
        $userId = session()->get('id');
        $sertifikat = $this->sertifikatModel->find($id);

        if (!$sertifikat || $sertifikat['user_id'] != $userId) {
            return redirect()->back()->with('error', 'Anda tidak memiliki izin untuk menghapus sertifikat ini.');
        }

        if ($this->sertifikatModel->delete($id)) {
            return redirect()->back()->with('success', 'Sertifikat berhasil dihapus.');
        }

        return redirect()->back()->with('error', 'Gagal menghapus sertifikat.');
    }

    public function preview($id)
    {
        $model = new \App\Models\SertifikatPesertaModel();

        $sertifikat = $model
            ->select('
                sertifikat_peserta.*,
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
            ->join('template_sertifikat', 'template_sertifikat.id = sertifikat_peserta.template_id')
            ->where('sertifikat_peserta.id', $id)
            ->first();

        if (!$sertifikat) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Sertifikat tidak ditemukan");
        }

        $userId = session()->get('id');
        if ($sertifikat['user_id'] != $userId) {
            return redirect()->back()->with('error', 'Anda tidak memiliki izin untuk melihat sertifikat ini.');
        }

        $sertifikat['provinsi']  = $sertifikat['provinsi']  ?? '-';
        $sertifikat['kabupaten'] = $sertifikat['kabupaten'] ?? '-';
        $sertifikat['kecamatan'] = $sertifikat['kecamatan'] ?? '-';
        $sertifikat['kelurahan'] = $sertifikat['kelurahan'] ?? '-';

        $sertifikat['background_url'] = base_url('uploads/templates/' . $sertifikat['background_img']);
        $sertifikat['ttd_url'] = $sertifikat['ttd_panitia']
            ? base_url('uploads/event/ttd/' . $sertifikat['ttd_panitia'])
            : null;

        return view('admin/sertifikat-preview', ['sertifikat' => $sertifikat]);
    }
}
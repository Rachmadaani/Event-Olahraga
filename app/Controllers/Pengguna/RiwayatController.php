<?php

namespace App\Controllers\Pengguna;

use App\Controllers\BaseController;
use App\Models\PendaftaranEventModel;

class RiwayatController extends BaseController
{
    protected $pendaftaranModel;

    public function __construct()
    {
        $this->pendaftaranModel = new PendaftaranEventModel();
    }

    public function index()
    {
        $userId = session()->get('id');

        if (!$userId) {
            return redirect()->to(base_url('login'))->with('error', 'Silakan login terlebih dahulu.');
        }

        $riwayat = $this->pendaftaranModel
            ->select('
                pendaftaran_event.id, 
                event.nama_event, 
                event.tanggal_event, 
                event.kelurahan,
                event.kecamatan,
                event.kabupaten,
                event.provinsi,
                event.lokasi as link_gmaps,
                kategori_event.nama_kategori as kategori,
                pendaftaran_event.status_pembayaran
            ')
            ->join('event', 'event.id = pendaftaran_event.event_id', 'left')
            ->join('kategori_event', 'kategori_event.id = pendaftaran_event.kategori_event_id', 'left')
            ->where('pendaftaran_event.user_id', $userId)
            ->orderBy('pendaftaran_event.created_at', 'DESC')
            ->findAll();

        return view('pengguna/riwayat', [
            'riwayat' => $riwayat,
        ]);
    }

    public function detail($id)
    {
        $userId = session()->get('id');

        $pendaftaran = $this->pendaftaranModel
            ->select('
                pendaftaran_event.*,
                event.nama_event,
                event.tanggal_event as event_tanggal,
                kategori_event.nama_kategori,
                kategori_event.rute,
                kategori_event.biaya
            ')
            ->join('event', 'event.id = pendaftaran_event.event_id', 'left')
            ->join('kategori_event', 'kategori_event.id = pendaftaran_event.kategori_event_id', 'left')
            ->where('pendaftaran_event.id', $id)
            ->where('pendaftaran_event.user_id', $userId)
            ->first();

        if (!$pendaftaran) {
            return redirect()->back()->with('error', 'Data pendaftaran tidak ditemukan atau bukan milik Anda.');
        }

        return view('pengguna/riwayat_detail', ['pendaftaran' => $pendaftaran]);
    }
}
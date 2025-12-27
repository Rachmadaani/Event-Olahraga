<?php

namespace App\Controllers\Pengguna;

use App\Controllers\BaseController;
use App\Models\EventModel;

class DashboardController extends BaseController
{
    protected $eventModel;

    public function __construct()
    {
        $this->eventModel = new EventModel();
    }

    public function index()
    {
        $keyword = $this->request->getGet('q');

        if (!empty($keyword)) {
            $events = $this->eventModel
                ->like('nama_event', $keyword)
                ->orLike('lokasi', $keyword)
                ->orLike('deskripsi', $keyword)
                ->where('tanggal_event >=', date('Y-m-d'))
                ->orderBy('tanggal_event', 'ASC')
                ->findAll();

            $data = [
                'events' => $events,
                'keyword' => $keyword
            ];
        } else {
            $events = $this->eventModel
                ->where('tanggal_event >=', date('Y-m-d'))
                ->orderBy('tanggal_event', 'ASC')
                ->findAll();

            $data = [
                'events' => $events
            ];
        }

        // SELALU gunakan view pengguna/beranda.php
        // atau sesuaikan dengan login status
        if (session()->get('logged_in')) {
            // Jika sudah login, tampilkan beranda untuk pengguna yang login
            return view('pengguna/beranda', $data);
        } else {
            // Jika belum login, tampilkan beranda untuk umum
            return view('pengguna/beranda', $data); // atau ganti dengan 'beranda' jika ingin view terpisah
        }
    }

    public function tentang()
    {
        return view('tentang');
    }

    public function kontak()
    {
        return view('kontak');
    }

    public function search()
    {
        return $this->index();
    }
}

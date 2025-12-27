<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\EventModel;

class EventController extends BaseController
{
    protected $eventModel;

    public function __construct()
    {
        $this->eventModel = new EventModel();
    }

    public function index()
    {
        $userId = session()->get('id');

        if (!$userId) {
            return redirect()->to('/login')->with('error', 'Sesi login berakhir. Silakan login kembali.');
        }

        // Debug log, hapus setelah testing
        // dd('User ID:', $userId);

        $data['events'] = $this->eventModel
            ->select('event.*, users.name AS nama_admin')
            ->join('users', 'users.id = event.user_id', 'left')
            ->where('event.user_id', $userId)
            ->orderBy('event.tanggal_event', 'DESC')
            ->findAll();

        return view('admin/event', $data);
    }

    public function store()
    {
        $userId = session()->get('id');

        $fileGambar = $this->request->getFile('gambar');
        $fileTTD    = $this->request->getFile('ttd_panitia');

        $gambarName = null;
        $ttdName    = null;

        if ($fileGambar && $fileGambar->isValid() && !$fileGambar->hasMoved()) {
            $gambarName = $fileGambar->getRandomName();
            $fileGambar->move('uploads/event/gambar', $gambarName);
        }

        if ($fileTTD && $fileTTD->isValid() && !$fileTTD->hasMoved()) {
            $ttdName = $fileTTD->getRandomName();
            $fileTTD->move('uploads/event/ttd', $ttdName);
        }

        $this->eventModel->insert([
            'user_id'       => $userId,
            'nama_event'    => $this->request->getPost('nama_event'),
            'tanggal_event' => $this->request->getPost('tanggal_event'),
            'provinsi'      => $this->request->getPost('provinsi'),
            'kabupaten'     => $this->request->getPost('kabupaten'),
            'kecamatan'     => $this->request->getPost('kecamatan'),
            'kelurahan'     => $this->request->getPost('kelurahan'),
            'lokasi'        => $this->request->getPost('lokasi'),
            'deskripsi'     => $this->request->getPost('deskripsi'),
            'gambar'        => $gambarName,
            'nama_panitia'  => $this->request->getPost('nama_panitia'),
            'no_hp_panitia' => $this->request->getPost('no_hp_panitia'),
            'ttd_panitia'   => $ttdName
        ]);

        return redirect()->to('/admin/event')->with('success', 'Event berhasil ditambahkan');
    }

    public function update($id)
    {
        $userId = session()->get('id');
        $event  = $this->eventModel->find($id);

        // pastikan event milik admin yang login
        if (!$event || $event['user_id'] != $userId) {
            return redirect()->to('/admin/event')
                ->with('error', 'Anda tidak memiliki izin untuk mengedit event ini.');
        }

        $fileGambar = $this->request->getFile('gambar');
        $fileTTD    = $this->request->getFile('ttd_panitia');

        $gambarName = $event['gambar'];
        $ttdName    = $event['ttd_panitia'];

        if ($fileGambar && $fileGambar->isValid() && !$fileGambar->hasMoved()) {
            $gambarName = $fileGambar->getRandomName();
            $fileGambar->move('uploads/event/gambar', $gambarName);
        }

        if ($fileTTD && $fileTTD->isValid() && !$fileTTD->hasMoved()) {
            $ttdName = $fileTTD->getRandomName();
            $fileTTD->move('uploads/event/ttd', $ttdName);
        }

        $this->eventModel->update($id, [
            'nama_event'    => $this->request->getPost('nama_event'),
            'tanggal_event' => $this->request->getPost('tanggal_event'),
            'provinsi'      => $this->request->getPost('provinsi'),
            'kabupaten'     => $this->request->getPost('kabupaten'),
            'kecamatan'     => $this->request->getPost('kecamatan'),
            'kelurahan'     => $this->request->getPost('kelurahan'),
            'lokasi'        => $this->request->getPost('lokasi'),
            'deskripsi'     => $this->request->getPost('deskripsi'),
            'gambar'        => $gambarName,
            'nama_panitia'  => $this->request->getPost('nama_panitia'),
            'no_hp_panitia' => $this->request->getPost('no_hp_panitia'),
            'ttd_panitia'   => $ttdName
        ]);

        return redirect()->to('/admin/event')->with('success', 'Event berhasil diperbarui');
    }

    public function delete($id)
    {
        $userId = session()->get('id');
        $event  = $this->eventModel->find($id);

        // pastikan event milik admin yang login
        if (!$event || $event['user_id'] != $userId) {
            return redirect()->to('/admin/event')
                ->with('error', 'Anda tidak memiliki izin untuk menghapus event ini.');
        }

        if ($event['gambar'] && file_exists('uploads/event/gambar/' . $event['gambar'])) {
            unlink('uploads/event/gambar/' . $event['gambar']);
        }

        if ($event['ttd_panitia'] && file_exists('uploads/event/ttd/' . $event['ttd_panitia'])) {
            unlink('uploads/event/ttd/' . $event['ttd_panitia']);
        }

        $this->eventModel->delete($id);

        return redirect()->to('/admin/event')->with('success', 'Event berhasil dihapus');
    }
}

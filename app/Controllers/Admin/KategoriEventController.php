<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\KategoriEventModel;
use App\Models\EventModel;

class KategoriEventController extends BaseController
{
    protected $kategoriEventModel;
    protected $eventModel;

    public function __construct()
    {
        $this->kategoriEventModel = new KategoriEventModel();
        $this->eventModel         = new EventModel();
    }

    public function index()
    {
        $userId = session()->get('id');

        $data['kategori_event'] = $this->kategoriEventModel->getKategoriWithEvent(null, $userId);
        $data['events'] = $this->eventModel
            ->where('user_id', $userId)
            ->orderBy('tanggal_event', 'DESC')
            ->findAll();

        return view('admin/kategori-event', $data);
    }

    public function store()
    {
        $this->kategoriEventModel->save([
            'event_id'      => $this->request->getPost('event_id'),
            'user_id'       => session()->get('id'),
            'nama_kategori' => $this->request->getPost('nama_kategori'),
            'deskripsi'     => $this->request->getPost('deskripsi'),
            'berbayar'      => $this->request->getPost('berbayar'),
            'biaya'         => $this->request->getPost('biaya'),
            'rute'          => $this->request->getPost('rute'),
            'tanggal_mulai' => $this->request->getPost('tanggal_mulai'),
            'jam_mulai'     => $this->request->getPost('jam_mulai'),
            'batas_waktu'   => $this->request->getPost('batas_waktu'),
            'keterangan'    => $this->request->getPost('keterangan'),
        ]);

        return redirect()->to(base_url('admin/kategori-event'))->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function update($id)
    {
        $this->kategoriEventModel->update($id, [
            'event_id'      => $this->request->getPost('event_id'),
            'nama_kategori' => $this->request->getPost('nama_kategori'),
            'deskripsi'     => $this->request->getPost('deskripsi'),
            'berbayar'      => $this->request->getPost('berbayar'),
            'biaya'         => $this->request->getPost('biaya'),
            'rute'          => $this->request->getPost('rute'),
            'tanggal_mulai' => $this->request->getPost('tanggal_mulai'),
            'jam_mulai'     => $this->request->getPost('jam_mulai'),
            'batas_waktu'   => $this->request->getPost('batas_waktu'),
            'keterangan'    => $this->request->getPost('keterangan'),
        ]);

        return redirect()->to(base_url('admin/kategori-event'))->with('success', 'Kategori berhasil diperbarui.');
    }

    public function delete($id)
    {
        $this->kategoriEventModel->delete($id);
        return redirect()->to(base_url('admin/kategori-event'))->with('success', 'Kategori berhasil dihapus.');
    }
}

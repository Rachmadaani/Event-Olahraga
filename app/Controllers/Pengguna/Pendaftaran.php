<?php

namespace App\Controllers\Pengguna;

use App\Controllers\BaseController;
use App\Models\PendaftaranEventModel;
use App\Models\EventModel;
use App\Models\KategoriEventModel;

class Pendaftaran extends BaseController
{
    protected $pendaftaranModel;
    protected $eventModel;
    protected $kategoriEventModel;

    public function __construct()
    {
        $this->pendaftaranModel   = new PendaftaranEventModel();
        $this->eventModel         = new EventModel();
        $this->kategoriEventModel = new KategoriEventModel();
    }

    public function index()
    {
        $eventId = $this->request->getGet('event_id');
        if ($eventId) {
            session()->set('selected_event_id', $eventId);
        }
        return view('pengguna/pendaftaran/step1');
    }

    public function saveStep1()
    {
        $userId = session()->get('id');
        if (!$userId) {
            return redirect()->to('/login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $data = [
            'user_id'                 => $userId,
            'nama_lengkap'            => $this->request->getPost('nama_lengkap'),
            'email'                   => $this->request->getPost('email'),
            'no_tlp'                  => $this->request->getPost('no_tlp'),
            'alamat_lengkap'          => $this->request->getPost('alamat_lengkap'),
            'provinsi'                => $this->request->getPost('provinsi'),
            'kabupaten'               => $this->request->getPost('kabupaten'),
            'kewarganegaraan'         => $this->request->getPost('kewarganegaraan'),
            'no_identitas'            => $this->request->getPost('no_identitas'),
            'goldar'                  => $this->request->getPost('goldar'),
            'jenis_kelamin'           => $this->request->getPost('jenis_kelamin'),
            'tanggal_lahir'           => $this->request->getPost('tanggal_lahir'),
            'riwayat_penyakit'        => $this->request->getPost('riwayat_penyakit'),
            'nama_kontak_darurat'     => $this->request->getPost('kontak_darurat_nama'),
            'nohp_kontak_darurat'     => $this->request->getPost('kontak_darurat_hp'),
            'hubungan_kontak_darurat' => $this->request->getPost('kontak_darurat_hubungan'),
        ];

        $pendaftaranId = $this->pendaftaranModel->insert($data, true);

        // Ambil event yang diklik di beranda (kalau ada)
        $eventId = session()->get('selected_event_id');
        if ($eventId) {
            return redirect()->to('pengguna/pendaftaran/step2/' . $pendaftaranId . '?event_id=' . $eventId);
        }

        return redirect()->to('pengguna/pendaftaran/step2/' . $pendaftaranId);
    }

    public function step2($pendaftaranId)
    {
        $userId = session()->get('id');
        if (!$userId) {
            return redirect()->to('/login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $eventId = $this->request->getGet('event_id');
        if (!$eventId) {
            return redirect()->to('/dashboard')->with('error', 'Event tidak ditemukan.');
        }

        // Ambil data event & kategori pertama yang sesuai event_id
        $event = $this->eventModel->find($eventId);
        $kategori = $this->kategoriEventModel
            ->where('event_id', $eventId)
            ->orderBy('id', 'ASC')
            ->first();

        if (!$event || !$kategori) {
            return redirect()->to('/dashboard')->with('error', 'Data event atau kategori tidak ditemukan.');
        }

        return view('pengguna/pendaftaran/step2', [
            'pendaftaranId' => $pendaftaranId,
            'event'         => $event,
            'kategori'      => $kategori,
        ]);
    }

    public function saveStep2($pendaftaranId)
    {
        $eventId          = $this->request->getPost('event_id');
        $kategoriEventId  = $this->request->getPost('kategori_event_id');

        $kategori = $this->kategoriEventModel->find($kategoriEventId);

        if (!$kategori) {
            return redirect()->back()->with('error', 'Kategori event tidak ditemukan.');
        }

        $this->pendaftaranModel->update($pendaftaranId, [
            'event_id'          => $this->request->getPost('event_id'),
            'kategori_event_id'  => $kategoriEventId,
            'rute'               => $kategori['rute'],
            'biaya'              => $kategori['biaya'],
            'admin_id'           => session()->get('id'),
            'ukuran_kaos'        => $this->request->getPost('ukuran_kaos'),
            'persetujuan_peserta' => $this->request->getPost('persetujuan') ?? 0,
        ]);

        if ($kategori['berbayar'] === 'berbayar') {
            return redirect()->to('pengguna/pendaftaran/step3/' . $pendaftaranId);
        } else {
            // TAMBAHKAN INI untuk notifikasi SweetAlert2
            session()->setFlashdata('pendaftaran_success', true);
            return redirect()->to('pengguna/pendaftaran/success/' . $pendaftaranId);
        }
    }

    public function getKategoriEvent($eventId)
    {
        $kategoris = $this->kategoriEventModel
            ->select('id, nama_kategori, rute, biaya, berbayar')
            ->where('event_id', $eventId)
            ->findAll();

        return $this->response->setJSON($kategoris);
    }

    public function step3($pendaftaranId)
    {
        $pendaftaran = $this->pendaftaranModel->getAllPendaftaran($pendaftaranId);

        return view('pengguna/pendaftaran/step3', [
            'pendaftaran' => $pendaftaran,
            'qrCode'      => base_url('uploads/qrcode.png'),
        ]);
    }

    public function saveStep3($pendaftaranId)
    {
        $buktiPembayaran = $this->request->getFile('bukti_pembayaran');
        $namaFile = null;

        if ($buktiPembayaran && $buktiPembayaran->isValid()) {
            $namaFile = $buktiPembayaran->getRandomName();
            $buktiPembayaran->move('uploads/bukti_pembayaran', $namaFile);
        }

        $this->pendaftaranModel->update($pendaftaranId, [
            'jumlah_pembayaran' => $this->request->getPost('jumlah_pembayaran'),
            'bukti_pembayaran'  => $namaFile,
            'status_pembayaran' => 'pending',
        ]);

        // TAMBAHKAN INI untuk notifikasi SweetAlert2
        session()->setFlashdata('pendaftaran_success', true);

        return redirect()->to('pengguna/pendaftaran/success/' . $pendaftaranId);
    }

    public function success($pendaftaranId)
    {
        $pendaftaran = $this->pendaftaranModel->getAllPendaftaran($pendaftaranId);
        
        // TAMBAHKAN INI untuk notifikasi SweetAlert2
        session()->setFlashdata('pendaftaran_success', true);

        return view('pengguna/pendaftaran/success', ['pendaftaran' => $pendaftaran]);
    }
}
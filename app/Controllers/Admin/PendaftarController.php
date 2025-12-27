<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\EventModel;
use App\Models\PendaftaranEventModel;

class PendaftarController extends BaseController
{
    protected $pendaftaranModel;
    protected $eventModel;

    public function __construct()
    {
        $this->pendaftaranModel = new PendaftaranEventModel();
        $this->eventModel       = new EventModel();
    }

    /**
     * Menampilkan daftar peserta hanya untuk event yang dibuat oleh admin yang sedang login.
     */
    public function index()
    {
        $adminId = session()->get('id');

        // Ambil semua event yang dibuat oleh admin ini
        $eventsAdmin = $this->eventModel
            ->where('user_id', $adminId)
            ->findAll();

        $eventIds = array_column($eventsAdmin, 'id');

        if (!empty($eventIds)) {
            // Pastikan hanya ambil peserta yang event_id-nya milik admin ini
            $pendaftar = $this->pendaftaranModel
                ->select('pendaftaran_event.*, event.nama_event, kategori_event.nama_kategori')
                ->join('event', 'event.id = pendaftaran_event.event_id', 'left')
                ->join('kategori_event', 'kategori_event.id = pendaftaran_event.kategori_event_id', 'left')
                ->whereIn('pendaftaran_event.event_id', $eventIds)
                ->findAll();
        } else {
            $pendaftar = [];
        }

        return view('admin/pendaftar/index', [
            'pendaftar' => $pendaftar
        ]);
    }

    /**
     * Detail peserta — hanya admin pembuat event yang bisa lihat
     */
    public function detail($id)
    {
        $adminId = session()->get('id');
        $pendaftar = $this->pendaftaranModel->getAllPendaftaran($id);

        if (!$pendaftar) {
            return redirect()->to('/admin/pendaftar')->with('error', 'Data peserta tidak ditemukan.');
        }

        $event = $this->eventModel->find($pendaftar['event_id']);
        if (!$event || $event['user_id'] != $adminId) {
            return redirect()->to('/admin/pendaftar')->with('error', 'Anda tidak berhak melihat data peserta ini.');
        }

        return view('admin/pendaftar/detail', ['pendaftar' => $pendaftar]);
    }

    /**
     * Hanya admin pemilik event yang bisa ubah status pembayaran.
     */
    public function ubahStatus($id)
    {
        $adminId = session()->get('id');
        $pendaftar = $this->pendaftaranModel->getAllPendaftaran($id);

        if (!$pendaftar) {
            return redirect()->back()->with('error', 'Data peserta tidak ditemukan.');
        }

        $event = $this->eventModel->find($pendaftar['event_id']);
        if (!$event || $event['user_id'] != $adminId) {
            return redirect()->to('/admin/pendaftar')->with('error', 'Anda tidak berhak mengubah status peserta ini.');
        }

        $statusBaru = $this->request->getPost('status_pembayaran');
        $this->pendaftaranModel->update($id, ['status_pembayaran' => $statusBaru]);

        return redirect()->to('/admin/pendaftar/detail/' . $id)->with('success', 'Status pembayaran berhasil diperbarui.');
    }

    /**
     * Hanya admin pembuat event yang bisa kirim email konfirmasi.
     */
    public function kirimEmail($id)
    {
        $adminId = session()->get('id');
        $pendaftar = $this->pendaftaranModel->getAllPendaftaran($id);

        if (!$pendaftar) {
            return redirect()->back()->with('error', 'Data tidak ditemukan.');
        }

        $event = $this->eventModel->find($pendaftar['event_id']);
        if (!$event || $event['user_id'] != $adminId) {
            return redirect()->to('/admin/pendaftar')->with('error', 'Anda tidak berhak mengirim email ini.');
        }

        if ($pendaftar['status_pembayaran'] != 'lunas') {
            return redirect()->back()->with('error', 'Hanya peserta dengan status lunas yang bisa dikirimi email.');
        }

        if (!empty($pendaftar['email_terkirim']) && $pendaftar['email_terkirim'] == 1) {
            return redirect()->back()->with('info', 'Email sudah pernah dikirim ke peserta ini.');
        }

        $email = \Config\Services::email();
        $email->setFrom('no_reply@gmail.com', 'Admin Event');
        $email->setTo($pendaftar['email']);
        $email->setSubject('Konfirmasi Pendaftaran Event');

        $message = "
        <div style='font-family: Arial, sans-serif; line-height: 1.6;'>
            <h2 style='color: #6AA8A2;'>Halo {$pendaftar['nama_lengkap']}!</h2>
            <p>Terima kasih telah melakukan pembayaran untuk event kami. Berikut detail pendaftaran Anda:</p>
            <table style='border-collapse: collapse; width: 100%; max-width: 600px;'>
                <tr>
                    <td style='border: 1px solid #ddd; padding: 8px;'><b>Nama Event</b></td>
                    <td style='border: 1px solid #ddd; padding: 8px;'>{$event['nama_event']}</td>
                </tr>
                <tr>
                    <td style='border: 1px solid #ddd; padding: 8px;'><b>Kategori Event</b></td>
                    <td style='border: 1px solid #ddd; padding: 8px;'>{$pendaftar['nama_kategori']}</td>
                </tr>
                <tr>
                    <td style='border: 1px solid #ddd; padding: 8px;'><b>Biaya</b></td>
                    <td style='border: 1px solid #ddd; padding: 8px;'>Rp " . number_format($pendaftar['biaya'], 0, ',', '.') . "</td>
                </tr>
                <tr>
                    <td style='border: 1px solid #ddd; padding: 8px;'><b>Status</b></td>
                    <td style='border: 1px solid #ddd; padding: 8px;'>{$pendaftar['status_pembayaran']}</td>
                </tr>
                <tr>
                    <td style='border: 1px solid #ddd; padding: 8px;'><b>No HP</b></td>
                    <td style='border: 1px solid #ddd; padding: 8px;'>{$pendaftar['no_tlp']}</td>
                </tr>
            </table>
            <p>Silakan simpan email ini sebagai bukti pendaftaran Anda.</p>
            <p>Salam,<br>Tim Event</p>
        </div>";

        $email->setMailType('html');
        $email->setMessage($message);

        if ($email->send()) {
            $this->pendaftaranModel->update($id, ['email_terkirim' => 1]);
            return redirect()->back()->with('success', 'Email berhasil dikirim ke peserta.');
        } else {
            $debug = $email->printDebugger(['headers', 'subject', 'body']);
            return redirect()->back()->with('error', 'Gagal mengirim email: ' . $debug);
        }
    }
}

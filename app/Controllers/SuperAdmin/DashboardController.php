<?php

namespace App\Controllers\SuperAdmin;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\EventModel;
use App\Models\KategoriEventModel;
use App\Models\PendaftaranEventModel;
use App\Models\SertifikatPesertaModel;
use App\Models\TemplateModel;

class DashboardController extends BaseController
{
    public function index()
    {
        $userModel = new UserModel();
        $eventModel = new EventModel();
        $kategoriEventModel = new KategoriEventModel();
        $peserta = new PendaftaranEventModel();
        $template = new TemplateModel();
        $sertifikat = new SertifikatPesertaModel();

        $data = [
            'total_admin'        => $userModel->where('role', 'admin')->countAllResults(),
            'total_pengguna'     => $userModel->where('role', 'pengguna')->countAllResults(),
            'total_event'        => $eventModel->countAllResults(),
            'total_kategori'     => $kategoriEventModel->countAllResults(),
            'total_peserta'      => $peserta->countAllResults(),
            'total_template'     => $template->countAllResults(),
            'total_sertifikat'   => $sertifikat->countAllResults(),
        ];

        return view('superadmin/dashboard', $data);
    }

    public function admin()
    {
        $userModel = new UserModel();
        $data['admins'] = $userModel->where('role', 'admin')->findAll();
        return view('superadmin/admin', $data);
    }

    public function pengguna()
    {
        $userModel = new UserModel();
        $data['penggunas'] = $userModel->where('role', 'pengguna')->findAll();
        return view('superadmin/pengguna', $data);
    }

    public function event()
    {
        $eventModel = new EventModel();
        $data['events'] = $eventModel->getEventWithUser();
        return view('superadmin/event', $data);
    }

    public function kategoriEvent()
    {
        $kategoriEventModel = new KategoriEventModel();
        $data['kategoriEvents'] = $kategoriEventModel->getKategoriWithEvent();
        return view('superadmin/kategori-event', $data);
    }

    public function peserta()
    {
        $pendaftaranEventModel = new PendaftaranEventModel();
        $pesertas = $pendaftaranEventModel->getAllPendaftaran();

        return view('superadmin/pendaftar', [
            'pesertas' => $pesertas
        ]);
    }

    public function template()
    {
        $templateModel = new TemplateModel();
        $templates = $templateModel->findAll();

        return view('superadmin/template', [
            'templates' => $templates
        ]);
    }

    public function sertifikat()
    {
        $sertifikatModel = new SertifikatPesertaModel();
        $sertifikats = $sertifikatModel->getSertifikatWithDetail();

        return view('superadmin/sertifikat', [
            'sertifikats' => $sertifikats
        ]);
    }
}

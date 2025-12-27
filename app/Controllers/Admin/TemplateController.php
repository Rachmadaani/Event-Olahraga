<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\TemplateModel;

class TemplateController extends BaseController
{
    protected $templateModel;

    public function __construct()
    {
        $this->templateModel = new TemplateModel();
    }

    public function index()
    {
        $userId = session()->get('id');

        // 🔒 tampilkan template yang tidak digunakan oleh admin lain
        $templates = $this->getTemplatesByAdmin($userId);

        return view('admin/template', ['templates' => $templates]);
    }

    private function getTemplatesByAdmin($userId)
    {
        $db = \Config\Database::connect();

        // Ambil semua template yang tidak digunakan oleh admin lain
        $query = "
            SELECT t.*
            FROM template_sertifikat t
            WHERE t.id NOT IN (
                SELECT sp.template_id
                FROM sertifikat_peserta sp
                JOIN pendaftaran_event pe ON pe.id = sp.pendaftaran_id
                JOIN event e ON e.id = pe.event_id
                WHERE e.user_id != {$userId}
            )
            ORDER BY t.created_at DESC
        ";

        return $db->query($query)->getResultArray();
    }

    public function store()
    {
        if (!$this->validate([
            'nama_template' => 'required|max_length[255]',
            'gambar'        => 'uploaded[gambar]|is_image[gambar]|max_size[gambar,4096]'
        ])) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $file = $this->request->getFile('gambar');
        $uploadPath = WRITEPATH . '../public/uploads/templates/';
        if (!is_dir($uploadPath)) mkdir($uploadPath, 0755, true);

        $fileName = $file->getRandomName();
        $file->move($uploadPath, $fileName);

        $this->templateModel->save([
            'nama_template' => $this->request->getPost('nama_template'),
            'gambar'        => $fileName
        ]);

        return redirect()->to('/admin/template')->with('success', 'Template berhasil ditambahkan');
    }

    public function update($id)
    {
        $template = $this->templateModel->find($id);
        if (!$template) {
            return redirect()->to('/admin/template')->with('error', 'Template tidak ditemukan');
        }

        if (!$this->validate([
            'nama_template' => 'required|max_length[255]',
            'gambar'        => 'is_image[gambar]|max_size[gambar,4096]'
        ])) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'nama_template' => $this->request->getPost('nama_template')
        ];

        // Cek apakah ada file baru diupload
        $file = $this->request->getFile('gambar');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $uploadPath = WRITEPATH . '../public/uploads/templates/';
            if (!is_dir($uploadPath)) mkdir($uploadPath, 0755, true);

            // hapus file lama
            if (is_file($uploadPath . $template['gambar'])) unlink($uploadPath . $template['gambar']);

            $fileName = $file->getRandomName();
            $file->move($uploadPath, $fileName);

            $data['gambar'] = $fileName;
        }

        $this->templateModel->update($id, $data);

        return redirect()->to('/admin/template')->with('success', 'Template berhasil diperbarui');
    }

    public function delete($id)
    {
        $userId = session()->get('id');
        $db = \Config\Database::connect();

        // 🔒 pastikan template tidak digunakan oleh admin lain
        $isUsed = $db->table('sertifikat_peserta sp')
            ->join('pendaftaran_event pe', 'pe.id = sp.pendaftaran_id')
            ->join('event e', 'e.id = pe.event_id')
            ->where('sp.template_id', $id)
            ->where('e.user_id !=', $userId)
            ->countAllResults();

        if ($isUsed > 0) {
            return redirect()->to('/admin/template')->with('error', 'Template ini digunakan oleh admin lain, tidak bisa dihapus.');
        }

        $template = $this->templateModel->find($id);
        if ($template) {
            $uploadPath = WRITEPATH . '../public/uploads/templates/';
            if (is_file($uploadPath . $template['gambar'])) unlink($uploadPath . $template['gambar']);
            $this->templateModel->delete($id);
        }

        return redirect()->to('/admin/template')->with('success', 'Template Sertifikat berhasil dihapus');
    }
}

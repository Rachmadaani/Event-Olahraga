<?php

namespace App\Models;

use CodeIgniter\Model;

class SertifikatPesertaModel extends Model
{
    protected $table            = 'sertifikat_peserta';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useTimestamps    = false;

    protected $allowedFields    = [
        'user_id',
        'pendaftaran_id',
        'template_id',
        'nomor_sertifikat',
        'file_sertifikat',
        'dibuat_pada',
        'diperbarui_pada',
    ];

    protected $beforeInsert = ['setCreatedAt'];
    protected $beforeUpdate = ['setUpdatedAt'];

    protected function setCreatedAt(array $data)
    {
        $now = date('Y-m-d H:i:s');
        $data['data']['dibuat_pada']     = $now;
        $data['data']['diperbarui_pada'] = $now;
        return $data;
    }

    protected function setUpdatedAt(array $data)
    {
        $data['data']['diperbarui_pada'] = date('Y-m-d H:i:s');
        return $data;
    }

    public function getSertifikatWithDetail($id = null)
    {
        $builder = $this->db->table($this->table)
            ->select('
                sertifikat_peserta.*,
                users.username AS nama_user,
                pendaftaran_event.nama_lengkap AS nama_peserta,
                event.nama_event,
                event.tanggal_event,
                event.lokasi,
                event.provinsi,
                event.kabupaten,
                event.kecamatan,
                event.kelurahan,
                event.nama_panitia,
                event.ttd_panitia,
                kategori_event.nama_kategori,
                template_sertifikat.nama_template
            ')
            ->join('users', 'users.id = sertifikat_peserta.user_id', 'left')
            ->join('pendaftaran_event', 'pendaftaran_event.id = sertifikat_peserta.pendaftaran_id')
            ->join('event', 'event.id = pendaftaran_event.event_id')
            ->join('kategori_event', 'kategori_event.id = pendaftaran_event.kategori_event_id', 'left')
            ->join('template_sertifikat', 'template_sertifikat.id = sertifikat_peserta.template_id', 'left');

        if ($id) {
            $builder->where('sertifikat_peserta.id', $id);
            return $builder->get()->getRowArray();
        }

        return $builder->get()->getResultArray();
    }
}

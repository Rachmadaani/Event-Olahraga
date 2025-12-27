<?php

namespace App\Models;

use CodeIgniter\Model;

class PendaftaranEventModel extends Model
{
    protected $table            = 'pendaftaran_event';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $useTimestamps    = true;

    protected $allowedFields    = [
        'user_id',
        'event_id',
        'kategori_event_id',
        'admin_id',

        'nama_lengkap',
        'email',
        'no_tlp',
        'alamat_lengkap',
        'provinsi',
        'kabupaten',
        'kewarganegaraan',
        'no_identitas',
        'goldar',
        'jenis_kelamin',
        'tanggal_lahir',
        'riwayat_penyakit',

        'nama_kontak_darurat',
        'nohp_kontak_darurat',
        'hubungan_kontak_darurat',

        'rute',
        'biaya',
        'ukuran_kaos',
        'persetujuan_peserta',

        'jumlah_pembayaran',
        'bukti_pembayaran',
        'status_pembayaran',
        'email_terkirim',
    ];

    public function getAllPendaftaran($id = null)
    {
        $builder = $this->db->table($this->table)
            ->select('
                pendaftaran_event.*,
                users.username AS peserta_username,
                event.nama_event,
                kategori_event.nama_kategori,
                admin.username AS admin_username
            ')
            ->join('users', 'users.id = pendaftaran_event.user_id')
            ->join('event', 'event.id = pendaftaran_event.event_id', 'left')
            ->join('kategori_event', 'kategori_event.id = pendaftaran_event.kategori_event_id', 'left')
            ->join('users AS admin', 'admin.id = pendaftaran_event.admin_id', 'left');

        if ($id) {
            $builder->where('pendaftaran_event.id', $id);
            return $builder->get()->getRowArray();
        }

        return $builder->get()->getResultArray();
    }
}

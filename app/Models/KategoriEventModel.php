<?php

namespace App\Models;

use CodeIgniter\Model;

class KategoriEventModel extends Model
{
    protected $table            = 'kategori_event';
    protected $primaryKey       = 'id';
    protected $useTimestamps    = true;
    protected $allowedFields    = [
        'event_id',
        'user_id',
        'nama_kategori',
        'deskripsi',
        'berbayar',
        'biaya',
        'rute',
        'tanggal_mulai',
        'jam_mulai',
        'batas_waktu',
        'keterangan'
    ];

    public function getKategoriWithEvent($id = null, $userId = null)
    {
        $builder = $this->db->table($this->table)
            ->select('kategori_event.*, event.nama_event, users.name AS nama_admin')
            ->join('event', 'event.id = kategori_event.event_id', 'left')
            ->join('users', 'users.id = event.user_id', 'left');

        if ($userId) {
            $builder->where('event.user_id', $userId);
        }

        if ($id) {
            $builder->where('kategori_event.id', $id);
            return $builder->get()->getRowArray();
        }

        return $builder->get()->getResultArray();
    }

    public function getByUser($userId)
    {
        return $this->select('kategori_event.*, event.nama_event')
            ->join('event', 'event.id = kategori_event.event_id')
            ->where('kategori_event.user_id', $userId)
            ->findAll();
    }
}

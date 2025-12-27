<?php

namespace App\Models;

use CodeIgniter\Model;

class EventModel extends Model
{
    protected $table = 'event';
    protected $primaryKey = 'id';
    protected $useTimestamps = true;

    protected $allowedFields = [
        'user_id',
        'nama_event',
        'tanggal_event',
        'provinsi',
        'kabupaten',
        'kecamatan',
        'kelurahan',
        'lokasi',
        'deskripsi',
        'gambar',
        'nama_panitia',
        'no_hp_panitia',
        'ttd_panitia'
    ];

    public function getEventsByUser($userId)
    {
        return $this->select('event.*, users.name AS nama_admin')
            ->join('users', 'users.id = event.user_id', 'left')
            ->where('event.user_id', $userId)
            ->orderBy('event.created_at', 'DESC')
            ->findAll();
    }

    // ✅ Tambahkan method ini
    public function getEventWithUser()
    {
        return $this->select('event.*, users.name AS username')
            ->join('users', 'users.id = event.user_id', 'left')
            ->orderBy('event.tanggal_event', 'ASC')
            ->findAll();
    }
}

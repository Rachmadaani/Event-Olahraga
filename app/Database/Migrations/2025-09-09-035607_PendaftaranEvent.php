<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class PendaftaranEvent extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'                   => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'user_id'              => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'event_id'             => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'null' => true],
            'kategori_event_id'    => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'null' => true],
            'admin_id'             => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'null' => true],

            'nama_lengkap'         => ['type' => 'VARCHAR', 'constraint' => 255],
            'email'                => ['type' => 'VARCHAR', 'constraint' => 255],
            'no_tlp'               => ['type' => 'VARCHAR', 'constraint' => 20],
            'alamat_lengkap'       => ['type' => 'TEXT'],
            'provinsi'          => ['type' => 'VARCHAR', 'constraint' => 100],
            'kabupaten'         => ['type' => 'VARCHAR', 'constraint' => 100],
            'kewarganegaraan'      => ['type' => 'VARCHAR', 'constraint' => 100],
            'no_identitas'         => ['type' => 'VARCHAR', 'constraint' => 50],
            'goldar'               => ['type' => 'VARCHAR', 'constraint' => 5, 'null' => true],
            'jenis_kelamin'        => ['type' => 'ENUM("Laki-laki","Perempuan")', 'null' => true],
            'tanggal_lahir'        => ['type' => 'DATE', 'null' => true],
            'riwayat_penyakit'     => ['type' => 'TEXT', 'null' => true],

            'nama_kontak_darurat'  => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'nohp_kontak_darurat'  => ['type' => 'VARCHAR', 'constraint' => 20, 'null' => true],
            'hubungan_kontak_darurat' => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => true],

            'rute'                 => ['type' => 'TEXT', 'null' => true],
            'biaya'                => ['type' => 'DECIMAL', 'constraint' => '10,2', 'null' => true],
            'ukuran_kaos'          => ['type' => 'ENUM("S","M","L","XL","XXL")', 'null' => true],
            'persetujuan_peserta'  => ['type' => 'TINYINT', 'constraint' => 1, 'default' => 0],

            'jumlah_pembayaran'    => ['type' => 'DECIMAL', 'constraint' => '10,2', 'null' => true],
            'bukti_pembayaran'     => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'status_pembayaran'    => ['type' => 'ENUM("pending","lunas","gagal")', 'default' => 'pending'],

            'created_at'           => ['type' => 'DATETIME', 'null' => true],
            'updated_at'           => ['type' => 'DATETIME', 'null' => true],
        ]);

        $this->forge->addKey('id', true);

        $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('event_id', 'event', 'id', 'CASCADE', 'SET NULL');
        $this->forge->addForeignKey('kategori_event_id', 'kategori_event', 'id', 'CASCADE', 'SET NULL');
        $this->forge->addForeignKey('admin_id', 'users', 'id', 'CASCADE', 'SET NULL');

        $this->forge->createTable('pendaftaran_event');
    }

    public function down()
    {
        $this->forge->dropTable('pendaftaran_event');
    }
}

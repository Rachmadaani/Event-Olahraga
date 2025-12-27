<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class KategoriEvent extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'              => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'event_id'        => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'user_id'         => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'nama_kategori'   => ['type' => 'VARCHAR', 'constraint' => 255],
            'deskripsi'       => ['type' => 'TEXT', 'null' => true],
            'berbayar'        => ['type' => 'ENUM("gratis","berbayar")', 'default' => 'gratis'],
            'biaya'           => ['type' => 'DECIMAL', 'constraint' => '10,2', 'null' => true],
            'rute'            => ['type' => 'TEXT', 'null' => true],
            'tanggal_mulai'   => ['type' => 'DATE'],
            'jam_mulai'       => ['type' => 'TIME'],
            'batas_waktu'     => ['type' => 'DATETIME', 'null' => true],
            'keterangan'      => ['type' => 'TEXT', 'null' => true],
            'created_at'      => ['type' => 'DATETIME', 'null' => true],
            'updated_at'      => ['type' => 'DATETIME', 'null' => true],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('event_id', 'event', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('kategori_event');
    }

    public function down()
    {
        $this->forge->dropTable('kategori_event');
    }
}

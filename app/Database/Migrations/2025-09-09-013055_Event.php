<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Event extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'                => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'user_id'           => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'nama_event'        => ['type' => 'VARCHAR', 'constraint' => 255],
            'tanggal_event'     => ['type' => 'DATE'],
            'provinsi'          => ['type' => 'VARCHAR', 'constraint' => 100],
            'kabupaten'         => ['type' => 'VARCHAR', 'constraint' => 100],
            'kecamatan'         => ['type' => 'VARCHAR', 'constraint' => 100],
            'kelurahan'         => ['type' => 'VARCHAR', 'constraint' => 100],
            'lokasi'            => ['type' => 'VARCHAR', 'constraint' => 255],
            'deskripsi'         => ['type' => 'TEXT', 'null' => true],
            'gambar'            => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'nama_panitia'      => ['type' => 'VARCHAR', 'constraint' => 100],
            'no_hp_panitia'     => ['type' => 'VARCHAR', 'constraint' => 20],
            'ttd_panitia'       => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'created_at'        => ['type' => 'DATETIME', 'null' => true],
            'updated_at'        => ['type' => 'DATETIME', 'null' => true],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('event');
    }

    public function down()
    {
        $this->forge->dropTable('event');
    }
}

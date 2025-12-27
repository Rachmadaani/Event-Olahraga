<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddEmailTerkirimToPendaftaranEvent extends Migration
{
    public function up()
    {
        $fields = [
            'email_terkirim' => [
                'type'       => 'TINYINT',
                'constraint' => 1,
                'default'    => 0,
                'after'      => 'status_pembayaran',
            ],
        ];

        $this->forge->addColumn('pendaftaran_event', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('pendaftaran_event', 'email_terkirim');
    }
}

<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class SuperadminSeeder extends Seeder
{
    public function run()
    {
        $data = [
            'name'     => 'Super Admin',
            'username' => 'superadmin',
            'email'    => 'superadmin@example.com',
            'password' => password_hash('superadmin123', PASSWORD_DEFAULT),
            'role'     => 'superadmin',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];

        $this->db->table('users')->insert($data);

        echo "Seeder Superadmin berhasil dijalankan!";
    }
}

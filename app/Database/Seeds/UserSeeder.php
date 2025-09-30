<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $data = [
            'name' => 'Admin',
            'email' => 'admin@123.com',
            'password' => password_hash('admin123', PASSWORD_DEFAULT),
            'phone_number' => '085702169158',
            'avatar' => '',
            'role' => 'admin',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];

        // Using Query Builder
        $this->db->table('users')->insert($data);
    }
}

<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $data = [
            "name" => "admin",
            "email" => "faqih3935@gmail.com",
            "username" => "admin",
            "password" => password_hash("faqih", PASSWORD_BCRYPT)
        ];

        $this->db->table('users')->insert($data);
    }
}

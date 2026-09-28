<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Tfa4UserPasswordSeeder extends Seeder
{
    public function run(): void
    {
        $this->db->table('users')->update([
            'password' => password_hash('Northstar123!', PASSWORD_DEFAULT),
        ]);
    }
}

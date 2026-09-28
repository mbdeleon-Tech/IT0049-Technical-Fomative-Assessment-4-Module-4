<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddPasswordToUsers extends Migration
{
    public function up(): void
    {
        $this->forge->addColumn('users', [
            'password' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => false,
                'default' => '$2y$10$ViIdqAFPcoyvDX.oJaDraOIfozkI8QYEQ85KUVK9GdK37WKWoycUu',
                'after' => 'full_name',
            ],
        ]);
    }

    public function down(): void
    {
        $this->forge->dropColumn('users', 'password');
    }
}

<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AlterUser extends Migration
{
    public function up()
    {
        $fields = [
            "nis" => ["type" => "varchar", "constraint" => 255, 'after' => 'id'],
            "nama" => ["type" => "varchar", "constraint" => 255, 'after' => 'username'],
            "kelas" => ["type" => "varchar", "constraint" => 255, 'after' => 'nama'],
            "angkatan" => ["type" => "int", "constraint" => 4, 'after' => 'kelas'],
            "no_hp" => ["type" => "varchar", "constraint" => 255, 'after' => 'angkatan'],
            "alamat" => ["type" => "varchar", "constraint" => 255, 'after' => 'no_hp'],
        ];
        
        $this->forge->addColumn('users', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('users', 'nis');
        $this->forge->dropColumn('users', 'nama');
        $this->forge->dropColumn('users', 'kelas');
        $this->forge->dropColumn('users', 'angkatan');
        $this->forge->dropColumn('users', 'no_hp');
        $this->forge->dropColumn('users', 'alamat');
    }
}

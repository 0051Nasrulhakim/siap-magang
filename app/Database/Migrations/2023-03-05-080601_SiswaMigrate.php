<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class SiswaMigrate extends Migration
{
    public function up()
    {
        $this->forge->addField([
            "id"        => ["type" => "int", "constraint" => 11, "unsigned" => true, "auto_increment" => true],
            "user_id"   => ['type' => 'int', 'constraint' => 11, 'unsigned' => true],
            "nis"       => ["type" => "varchar", "constraint" => 255],
            "nama"      => ["type" => "varchar", "constraint" => 255],
            "kelas"     => ["type" => "varchar", "constraint" => 255],
            "angkatan"  => ["type" => "int", "constraint" => 11, "unsigned" => true],
            "no_hp"     => ["type" => "varchar", "constraint" => 255],
            "alamat"    => ["type" => "varchar", "constraint" => 255],
            'created_at' => ['type' => 'datetime', 'null' => true],
            'updated_at' => ['type' => 'datetime', 'null' => true],
            'deleted_at' => ['type' => 'datetime', 'null' => true],
        ]);
        
        $this->forge->addKey("id", true);
        $this->forge->addKey(["user_id", "angkatan"]);
        $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey("angkatan", "angkatan", "id", "CASCADE", "RESTRICT");
        $this->forge->createTable("siswa", true);
    }

    public function down()
    {
        $this->forge->dropTable("siswa", true);
    }
}

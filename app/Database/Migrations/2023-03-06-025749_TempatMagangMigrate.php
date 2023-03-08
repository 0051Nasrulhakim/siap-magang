<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TempatMagangMigrate extends Migration
{
    public function up()
    {
        // field : id, kuota, nama, alamat, hp, email, deskripsi, status, created_at, updated_at, deleted_at
        $this->forge->addField([
            'id' => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'status' => ['type' => 'enum', 'constraint' => ['buka', 'tutup'], 'default' => 'buka'],
            'kuota' => ['type' => 'int', 'constraint' => 11, 'unsigned' => true],
            'nama' => ['type' => 'varchar', 'constraint' => 255],
            'hp' => ['type' => 'varchar', 'constraint' => 255],
            'email' => ['type' => 'varchar', 'constraint' => 255],
            'alamat' => ['type' => 'varchar', 'constraint' => 255],
            'deskripsi' => ['type' => 'varchar', 'constraint' => 255],
            'foto' => ['type' => 'varchar', 'constraint' => 255],
            'created_at' => ['type' => 'datetime', 'null' => true],
            'updated_at' => ['type' => 'datetime', 'null' => true],
            'deleted_at' => ['type' => 'datetime', 'null' => true],
        ]); 

        $this->forge->addKey('id', true);
        $this->forge->createTable('tempat_magang', true);
    }

    public function down()
    {
        $this->forge->dropTable('tempat_magang', true);
    }
}

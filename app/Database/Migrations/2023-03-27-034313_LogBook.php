<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class LogBook extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'            => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true,],
            'id_siswa'      => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true,],
            'id_tempat'     => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true,],
            'id_pembimbing' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true,],
            'tanggal'       => ['type' => 'DATE',],
            'jam_masuk'     => ['type' => 'TIME',],
            'jam_keluar'    => ['type' => 'TIME',],
            'keterangan'    => ['type' => 'VARCHAR', 'constraint' => '255'],
            'kegiatan'      => ['type' => 'TEXT',],
            'status'        => ['type' => 'ENUM', 'constraint' => ['pending', 'approved', 'rejected'], 'default' => 'pending',],
            'created_at'    => ['type' => 'DATETIME', 'null' => true,],
            'updated_at'    => ['type' => 'DATETIME', 'null' => true,],
            'deleted_at'    => ['type' => 'DATETIME', 'null' => true,],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('id_siswa', 'siswa', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_tempat', 'tempat_magang', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_pembimbing', 'pembimbing', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('logbooks', true);
    }

    public function down()
    {
        $this->forge->dropTable('logbooks', true);
    }
}

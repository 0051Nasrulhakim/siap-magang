<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class NilaiMigrate extends Migration
{
    public function up()
    {
        $this->forge->addField([
            "id"                => ['type' => 'INT', 'constraint' => 11, 'auto_increment' => true,],
            "idt"               => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true,],
            "ids"               => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            "n_disiplin"        => ['type' => 'INT', 'constraint' => 3,],
            "n_motivasi"        => ['type' => 'INT', 'constraint' => 3,],
            "n_kehadiran"       => ['type' => 'INT', 'constraint' => 3,],
            "n_kreatifitas"     => ['type' => 'INT', 'constraint' => 3,],
            "n_kejujuran"       => ['type' => 'INT', 'constraint' => 3,],
            "n_kesopanan"       => ['type' => 'INT', 'constraint' => 3,],
            "n_kerjasama"       => ['type' => 'INT', 'constraint' => 3,],
            "n_laporan"         => ['type' => 'INT', 'constraint' => 3,],
            "created_at"        => ['type' => 'DATETIME', 'null' => true,],
            "updated_at"        => ['type' => 'DATETIME', 'null' => true,],
            "deleted_at"        => ['type' => 'DATETIME', 'null' => true,],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('idt', 'tempat_magang', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('ids', 'siswa', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('nilai', true);
    }

    public function down()
    {
        $this->forge->dropTable('nilai', true);
    }
}

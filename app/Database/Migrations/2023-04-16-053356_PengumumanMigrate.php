<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class PengumumanMigrate extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'judul' => ['type' => 'VARCHAR', 'constraint' => 255],
            'isi' => ['type' => 'TEXT'],
            'oleh' => ['type' => 'INT', 'null' => false, 'unsigned' => true],
            'lampiran' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
            'deleted_at' => ['type' => 'DATETIME', 'null' => true],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('oleh', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('pengumuman', true);
    }

    public function down()
    {
        $this->forge->dropTable('pengumuman', true);
    }
}

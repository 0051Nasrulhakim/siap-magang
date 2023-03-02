<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class KelasMigrate extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => ['type' => 'int', 'constraint' => 11, 'auto_increment' => true],
            'kelas' => ['type' => 'varchar', 'constraint' => 255],
            'jurusan' => ['type' => 'int', 'constraint' => 11],

            'created_at' => ['type' => 'datetime', 'null' => true],
            'updated_at' => ['type' => 'datetime', 'null' => true],
            'deleted_at' => ['type' => 'datetime', 'null' => true],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('jurusan', 'jurusan', 'id', 'RESTRICT', 'RESTRICT');
        $this->forge->createTable('kelas', true);

    }

    public function down()
    {
        $this->forge->dropTable('kelas', true);
    }
}

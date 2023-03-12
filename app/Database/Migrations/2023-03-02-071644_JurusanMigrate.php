<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class JurusanMigrate extends Migration
{
    public function up()
    {
        $fields = [
            "id"            => ["type" => "int", "constraint" => 11, 'auto_increment' => true],
            "nama_jurusan"  => ["type" => "varchar", "constraint" => 255, 'after' => 'id'],
            'created_at'    => ['type' => 'datetime', 'null' => true],
            'updated_at'    => ['type' => 'datetime', 'null' => true],
            'deleted_at'    => ['type' => 'datetime', 'null' => true],
        ];

        $this->forge->addField($fields);
        $this->forge->addKey('id', true);
        $this->forge->createTable('jurusan', true);
    }

    public function down()
    {
        $this->forge->dropTable('jurusan', true);
    }
}

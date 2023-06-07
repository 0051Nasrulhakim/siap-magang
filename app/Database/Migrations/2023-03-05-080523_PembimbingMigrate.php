<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class PembimbingMigrate extends Migration
{
    public function up()
    {
        // Pembimbing field: id, users_id, nama, no_hp, email, 
        $this->forge->addField([
            "id"        => ["type" => "int", "constraint" => 11, "unsigned" => true, "auto_increment" => true],
            "user_id"   => ["type" => "int", "constraint" => 11, "unsigned" => true],
            "nama"      => ["type" => "varchar", "constraint" => 255],
            "no_hp"     => ["type" => "varchar", "constraint" => 255],
            "email"     => ["type" => "varchar", "constraint" => 255],
            'created_at' => ['type' => 'datetime', 'null' => true],
            'updated_at' => ['type' => 'datetime', 'null' => true],
            'deleted_at' => ['type' => 'datetime', 'null' => true],
        ]);

        $this->forge->addKey("id", true);
        $this->forge->addKey("user_id");
        $this->forge->addForeignKey("user_id", "users", "id", "", "CASCADE");
        $this->forge->createTable("pembimbing", true);
    }

    public function down()
    {
        $this->forge->dropTable("pembimbing", true);
    }
}

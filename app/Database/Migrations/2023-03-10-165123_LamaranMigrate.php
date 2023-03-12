<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class LamaranMigrate extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'            =>['type'=>'INT','constraint'=>11,'unsigned'=>true,'auto_increment'=>true],
            'id_siswa'      =>['type'=>'INT','constraint'=>11,'unsigned'=>true],
            'id_tempat'     =>['type'=>'INT','constraint'=>11,'unsigned'=>true, 'null'=>true],
            'status'        =>['type'=>'ENUM','constraint'=>['pending','accepted','rejected','selesai'],'default'=>'pending'],
            'created_at'    =>['type'=>'DATETIME','null'=>true],
            'updated_at'    =>['type'=>'DATETIME','null'=>true],
            'deleted_at'    =>['type'=>'DATETIME','null'=>true]
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addKey(['id_siswa', 'id_tempat']);
        $this->forge->addForeignKey('id_tempat', 'tempat_magang', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_siswa', 'siswa', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('lamaran', true);
    }

    public function down()
    {
        $this->forge->dropTable('lamaran', true);
    }
}

<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class InitialSeed extends Seeder
{
    public function run()
    {
        // Jurusan 
        $jurusan = new \App\Models\JurusanModel();
        $jurusan->insertBatch([
            ['id'=> 1, 'nama_jurusan' => 'RPL',],
            ['id'=> 2, 'nama_jurusan' => 'TKJ',]
        ]);


        // kelas 
        $kelas = new \App\Models\KelasModel();
        $kelas->insertBatch([
            ['kelas' => "XI", 'jurusan' => 1],
            ['kelas' => "XI", 'jurusan' => 2],
        ]);
    }
}

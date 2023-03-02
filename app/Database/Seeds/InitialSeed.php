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
        
        // angkatan
        $angkatan = new \App\Models\AngkatanModel();
        $angkatan->insertBatch([
            ['tahun' => 2021],
            ['tahun' => 2022],
        ]);
    }
}

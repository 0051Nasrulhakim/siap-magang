<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class InitialSeed extends Seeder
{
    public function run()
    {
        $fake = \Faker\Factory::create('id_ID');

        // group 
        $this->db->table('auth_groups')->insertBatch([
            ['name' => 'admin', 'description' => 'Site Administrator'],
            ['name' => 'pembimbing', 'description' => 'Pembimbing magang'],
            ['name' => 'siswa', 'description' => 'Siswa'],
        ]);


        // Jurusan 
        $jurusan = new \App\Models\JurusanModel();
        $jurusan->insertBatch([
            ['id' => 1, 'nama_jurusan' => 'RPL',],
            ['id' => 2, 'nama_jurusan' => 'TKJ',],
            ['id' => 2, 'nama_jurusan' => 'TKR',]
        ]);


        // angkatan
        $angkatan = new \App\Models\AngkatanModel();
        $angkatan->insertBatch([
            ['tahun' => 2019],
            ['tahun' => 2021],
            ['tahun' => 2022],
        ]);


        // Pembimbing 
        $pembimbing = new \App\Models\PembimbingModel();
        $user       = new \App\Models\UserModel();
        $idPembimbing = [];
        for ($i = 0; $i < $fake->numberBetween(10, 15); $i++) {
            $fakeEmail = $fake->freeEmail();
            if ($user->withGroup('pembimbing')->save(new \App\Entities\User([
                "email"     => $fakeEmail,
                "username"  => 'pembimbing' . ($i + 1),
                "password"  => '12345678',
                "active"    => 1,
            ]))) {
                $id = $user->getInsertID();
                $pembimbing->save([
                    'user_id'   => $id,
                    'nama'      => $fake->firstName() . ' ' . $fake->lastName(),
                    'no_hp'     => $fake->phoneNumber(),
                    'email'     => $fakeEmail,
                ]);
                $idPembimbing[] = $pembimbing->getInsertID();
            } else {
                $user->delete($user->getInsertID());
                echo implode(", ", $user->errors()) . "\n";
            }
        }


        // Admin
        $user->withGroup('admin')->insert(new \App\Entities\User([
            "email"     => 'admin@gmail.com',
            "username"  => 'admin',
            "password"  => '12345678',
            "active"    => 1,
        ]));
        $pembimbing->save([
            'user_id'   => $user->getInsertID(),
            'nama'      => $fake->firstName(),
            'no_hp'     => $fake->e164PhoneNumber(),
            'email'     => $fake->email(),
        ]);


        // id angkatan
        $idAngkatan = [];
        foreach ($angkatan->select('id')->findAll() as $key => $value) {
            $idAngkatan[] = $value->id;
        }


        // Siswa
        $idSiswa = [];
        $siswa = new \App\Models\SiswaModel();
        for ($i = 0; $i < $fake->numberBetween(30, 45); $i++) {
            $fakeEmail = $fake->freeEmail();
            if ($user->withGroup('siswa')->save(new \App\Entities\User([
                "email"     => $fakeEmail,
                "username"  => 'siswa' . ($i + 1),
                "password"  => '12345678',
                "active"    => 1,
            ]))) {
                $siswa->save([
                    "user_id"   => $user->getInsertID(),
                    "nis"       => $fake->randomElement(['19.', '20.', '21.']) . $fake->randomNumber(6, true),
                    "nama"      => $fake->firstName() . ' ' . $fake->lastName(),
                    "kelas"     => $fake->randomElement(['XI TKJ', 'XI RPL', 'XI TKR']),
                    "angkatan"  => $fake->randomElement($idAngkatan),
                    "no_hp"     => $fake->e164PhoneNumber(),
                    "alamat"    => $fake->streetAddress()
                ]);
                $idSiswa[] = $siswa->getInsertID();
            } else {
                $siswa->delete($user->getInsertID());
                echo implode(", ", $user->errors()) . "\n";
            }
        }


        // Tempat Magang
        $idTempat = [];
        $tempat = new \App\Models\TempatModel();
        for ($i = 0; $i < $fake->numberBetween(13, 25); $i++) {
            $tempat->save([
                'pid'           => $fake->randomElement($idPembimbing),
                'status'        => $fake->randomElement(['buka', 'tutup']),
                'kuota'         => $fake->randomDigitNot(0),
                'nama'          => $fake->company(),
                'hp'            => $fake->e164PhoneNumber(),
                'email'         => $fake->companyEmail(),
                'alamat'        => $fake->address(),
                'deskripsi'     => $fake->paragraph(2),
                'foto'          => 'https://source.unsplash.com/random/800x600?sig=' . $fake->randomNumber(5, true),
            ]);
            $idTempat[] = $tempat->getInsertID();
        }


        // Application
        $application = new \App\Models\ApplicationModel();
        for ($i = 0; $i <= count($idSiswa); $i++) {
            $ids = $fake->randomElement($idSiswa);
            $idSiswa = array_diff($idSiswa, [$ids]);

            if (!$application->save([
                'id_siswa'      => $ids,
                'id_tempat'     => $fake->randomElement($idTempat),
                'status'        => $fake->randomElement(['pending', 'accepted', 'rejected', 'selesai']),
                // 'tanggal_mulai' => $fake->dateTimeBetween('-1 month', '+1 month')->format('Y-m-d'),
                // 'tanggal_selesai' => $fake->dateTimeBetween('+1 month', '+3 month')->format('Y-m-d'),
            ])) {
                echo implode(", ", $application->errors()) . "\n";
            }
        }
    }
}

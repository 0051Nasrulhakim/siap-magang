<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class InitialSeed extends Seeder
{
    public function run()
    {
        /**
         * =============== FAKE DATA ===============
         * faker initialize
         */
        $fake = \Faker\Factory::create('id_ID');


        /**
         * =============== GROUP USER =============== 
         * input group user
         */
        $this->db->table('auth_groups')->insertBatch([
            ['name' => 'admin', 'description' => 'Site Administrator'],
            ['name' => 'pembimbing', 'description' => 'Pembimbing magang'],
            ['name' => 'siswa', 'description' => 'Siswa'],
        ]);


        /**
         * =============== JURUSAN ===============
         * input jurusan
         */
        $jurusan = new \App\Models\JurusanModel();
        $jurusan->insertBatch([
            ['id' => 1, 'nama_jurusan' => 'RPL',],
            ['id' => 2, 'nama_jurusan' => 'TKJ',],
            ['id' => 2, 'nama_jurusan' => 'TKR',]
        ]);


        /**
         * =============== ANGKATAN ===============
         * input angkatan
         */
        $angkatan = new \App\Models\AngkatanModel();
        $angkatan->insertBatch([
            ['tahun' => 2023, 'nama' => '2023 Gelombang 1', 'tgl_mulai' => '2023-03-03', 'tgl_selesai' => '2023-05-03'],
            ['tahun' => 2023, 'nama' => '2023 Gelombang 2', 'tgl_mulai' => '2023-05-05', 'tgl_selesai' => '2023-07-05'],
        ]);


        /**
         * =============== PEMBIMBING ===============
         * input user as pembimbing
         */
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


        /**
         * =============== ADMIN ===============
         * input user as admin
         */
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


        /**
         * =============== ID ANGKATAN ===============
         * get all id angkatan
         */
        $idAngkatan = [];
        foreach ($angkatan->select('id')->findAll() as $key => $value) {
            $idAngkatan[] = $value->id;
        }


        /**
         * =============== SISWA ===============
         * input user as siswa
         */
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
                    "nis"       => $fake->randomNumber(7, true),
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


        /**
         * =============== TEMPAT MAGANG ===============
         * input tempat magang
         */
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
                'foto'          => 'https://propertywiselaunceston.com.au/wp-content/themes/property-wise/images/no-image@2x.png',
            ]);
            $idTempat[] = $tempat->getInsertID();
        }


        /**
         * =============== PENGUMUMAN ===============
         * input pengumuman
         */
        $pengumuman = new \App\Models\PengumumanModel();
        for ($i = 0; $i < $fake->numberBetween(5, 10); $i++) {
            $pengumuman->save([
                'judul'        => $fake->sentence(5),
                'isi'          => $fake->paragraph(4),
                'oleh'         => $fake->randomElement($idPembimbing),
                'lampiran'     => 'https://propertywiselaunceston.com.au/wp-content/themes/property-wise/images/no-image@2x.png',
            ]);
        }


        /**
         * =============== APPLICATION ===============
         * input application / pendaftaran siswa
         */
        // $application = new \App\Models\ApplicationModel();
        // for ($i = 0; $i <= count($idSiswa); $i++) {
        //     $ids = $fake->randomElement($idSiswa);
        //     $idSiswa = array_diff($idSiswa, [$ids]);

        //     if (!$application->save([
        //         'id_siswa'      => $ids,
        //         'id_tempat'     => $fake->randomElement($idTempat),
        //         'status'        => $fake->randomElement(['pending', 'accepted', 'rejected', 'selesai']),
        //         // 'tanggal_mulai' => $fake->dateTimeBetween('-1 month', '+1 month')->format('Y-m-d'),
        //         // 'tanggal_selesai' => $fake->dateTimeBetween('+1 month', '+3 month')->format('Y-m-d'),
        //     ])) {
        //         echo implode(", ", $application->errors()) . "\n";
        //     }
        // }
    }
}

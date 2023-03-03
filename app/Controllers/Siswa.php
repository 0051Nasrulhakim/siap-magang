<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Entities\User as UserEntity;

class Siswa extends BaseController
{
    protected $user;

    public function __construct() {
        $this->user = new \App\Models\UserModel();
    }

    public function store()
    {
        $nis = str_replace(".", "", $this->request->getPost("nis"));

        $data = [
            "nis" => $this->request->getPost("nis"),
            "email" => $this->request->getPost("email"),
            "username" => $nis,
            "nama" => $this->request->getPost("nama"),
            "kelas" => $this->request->getPost("kelas"),
            "angkatan" => $this->request->getPost("angkatan"),
            "no_hp" => $this->request->getPost("hp"),
            "alamat" => $this->request->getPost("alamat"),
            "password" => $nis,
            "active" => 1,
        ];

        $data = new UserEntity($data);

        if ($this->user->withGroup('siswa')->save($data)) {
            return $this->response->setJSON([
                'status'    => 200,
                'success'   => true,
                'message'   => 'Siswa berhasil ditambahkan'
            ]);
        } else {
            return $this->response->setJSON([
                'status'    => 500,
                'success'   => false,
                'message'   => 'Siswa gagal ditambahkan'
            ]);
        }
    }
    
    public function update()
    {
        $nis = str_replace(".", "", $this->request->getPost("nis"));
        $old_nis = $this->request->getPost("old_nis");  
        $old_email = $this->request->getPost("old_email");  

        $data = [
            "id" => $this->request->getPost("items"),
            "nis" => $this->request->getPost("nis"),
            "nama" => $this->request->getPost("nama"),
            "kelas" => $this->request->getPost("kelas"),
            "angkatan" => $this->request->getPost("angkatan"),
            "no_hp" => $this->request->getPost("hp"),
            "alamat" => $this->request->getPost("alamat"),
        ];

        if ($this->request->getPost("nis") != $old_nis) {
            $data["username"] = $nis;
            $data["password"] = $nis;
            $data["active"] = 1;
        }

        if ($this->request->getPost("email") != $old_email) {
            $data["email"] = $this->request->getPost("email");
        }

        $data = new UserEntity($data);

        if ($this->user->save($data)) {
            return $this->response->setJSON([
                'status'    => 200,
                'success'   => true,
                'message'   => 'Siswa berhasil diperbarui',
                'data'      => $data
            ]);
        } else {
            return $this->response->setJSON([
                'status'    => 500,
                'success'   => false,
                'message'   => implode(", ", $this->user->errors())
            ]);
        }
    }

    public function destroy($id)
    {
        if ($this->user->delete($id)) {
            return $this->response->setJSON([
                'status'    => 200,
                'success'   => true,
                'message'   => 'Siswa berhasil dihapus'
            ]);
        } else {
            return $this->response->setJSON([
                'status'    => 500,
                'success'   => false,
                'message'   => 'Siswa gagal dihapus'
            ]);
        }
    }
}

<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Entities\User as UserEntity;

class Siswa extends BaseController
{
    protected $user;
    protected $siswa;
    protected $angkatan;
    protected $jurusan;

    public function __construct() {
        $this->user = new \App\Models\UserModel();
        $this->siswa = new \App\Models\SiswaModel();
        $this->angkatan = new \App\Models\AngkatanModel();
        $this->jurusan = new \App\Models\JurusanModel();
    }

    public function index()
    {
        $dsiswa = $this->user
            ->select('users.id, users.username, users.email, siswa.nis, siswa.nama, siswa.kelas, siswa.no_hp, siswa.alamat, angkatan.tahun as angkatan')
            ->join('siswa', 'siswa.user_id = users.id', 'inner')
            ->join('angkatan', 'angkatan.id = siswa.angkatan', "inner")
            ->findAll();

        return view('siswa_add', [
            "title"         => "Magang | Manajemen Siswa",
            "page_title"    => "Manajemen Data Siswa",
            "segment"       => $this->request->getUri()->getSegments(),
            "breadcrumb"    => ['Manajemen', 'Siswa'],
            "angkatan"      => $this->angkatan->findAll(),
            "jurusan"       => $this->jurusan->findAll(),
            "siswa"         => $dsiswa
        ]);
    }

    public function ceknis()
    {
        $nis = str_replace(".", "", $this->request->getPost("nis"));
        $cek = $this->siswa->where("nis", $nis);
        if ($cek->countAllResults() > 0) {
            return $this->response->setJSON([
                'assigned' => true
            ]);
        } else {
            return $this->response->setJSON([
                'assigned' => false
            ]);
        }
    }

    public function store()
    {
        $nis = str_replace(".", "", $this->request->getPost("nis"));

        $siswa_user = new UserEntity([
            "email" => $this->request->getPost("email"),
            "username" => $nis,
            "password" => $nis,
            "active" => 1
        ]);
        
        $siswa_detail = [
            "nis" => $this->request->getPost("nis"),
            "nama" => $this->request->getPost("nama"),
            "kelas" => $this->request->getPost("kelas"),
            "angkatan" => $this->request->getPost("angkatan"),
            "no_hp" => $this->request->getPost("hp"),
            "alamat" => $this->request->getPost("alamat")
        ];
    
        if ($this->user->withGroup('siswa')->save($siswa_user)) {
            $siswa_detail["user_id"] = $this->user->getInsertID();
            $siswa = new UserEntity($siswa_detail);

            if ($this->siswa->save($siswa)) {
                return $this->response->setJSON([
                    'status'    => 200,
                    'success'   => true,
                    'message'   => 'Siswa berhasil ditambahkan',
                    'data'      => $siswa
                ]);
            } else {
                return $this->response->setJSON([
                    'status'    => 500,
                    'success'   => false,
                    'message'   => implode(", ", $this->siswa->errors())
                ]);
            }
        } else {
            return $this->response->setJSON([
                'status'    => 500,
                'success'   => false,
                'message'   => implode(", ", $this->user->errors())
            ]);
        }
    }

    public function update()
    {
        $siswa_user = [];

        $nis = str_replace(".", "", $this->request->getPost("nis"));
        $old_nis = $this->request->getPost("old_nis");  
        $old_email = $this->request->getPost("old_email");  

        $siswa_detail = [
            "nis" => $this->request->getPost("nis"),
            "nama" => $this->request->getPost("nama"),
            "kelas" => $this->request->getPost("kelas"),
            "angkatan" => $this->request->getPost("angkatan"),
            "no_hp" => $this->request->getPost("hp"),
            "alamat" => $this->request->getPost("alamat")
        ];


        if ($this->request->getPost("nis") != $old_nis) {
            $siswa_user["username"] = $nis;
            $siswa_user["password"] = $nis;
            $siswa_user["active"] = 1;
        }

        if ($this->request->getPost("email") != $old_email) {
            $siswa_user["email"] = $this->request->getPost("email");
        }
        
        // if siswa_user not empty
        if (!empty($siswa_user)) {
            $siswa_user = new UserEntity($siswa_user);
            if($this->user->update($this->request->getPost("items"), $siswa_user)) {
                $id = $this->siswa->where("nis", $old_nis)->first()->id;

                if ($this->siswa->update($id, $siswa_detail)) {
                    return $this->response->setJSON([
                        'status'    => 200,
                        'success'   => true,
                        'message'   => 'Siswa berhasil diperbarui',
                        'data'      => $siswa_detail
                    ]);
                } else {
                    return $this->response->setJSON([
                        'status'    => 500,
                        'success'   => false,
                        'message'   => implode(", ", $this->siswa->errors())
                    ]);
                }
            } else {
                return $this->response->setJSON([
                    'status'    => 500,
                    'success'   => false,
                    'message'   => implode(", ", $this->user->errors())
                ]);
            }
        } else {
            $id = $this->siswa->where("nis", $old_nis)->first()->id;

            if ($this->siswa->update($id, $siswa_detail)) {
                return $this->response->setJSON([
                    'status'    => 200,
                    'success'   => true,
                    'message'   => 'Siswa berhasil diperbarui',
                    'data'      => $siswa_detail
                ]);
            } else {
                return $this->response->setJSON([
                    'status'    => 500,
                    'success'   => false,
                    'message'   => implode(", ", $this->siswa->errors())
                ]);
            }
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

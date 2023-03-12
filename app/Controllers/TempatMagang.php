<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class TempatMagang extends BaseController
{
    protected $tempat;

    public function __construct() {
        $this->tempat = new \App\Models\TempatModel();
    }

    public function store()
    {
        $file = $this->request->getFile('foto');
        $file_name = $file->getRandomName();
        $data = [
            'status'        => $this->request->getPost('status'),
            'pid'           => $this->request->getPost('pembimbing'),
            'kuota'         => $this->request->getPost('kuota'),
            'nama'          => $this->request->getPost('nama'),
            'hp'            => $this->request->getPost('kontak'),
            'email'         => $this->request->getPost('email'),
            'alamat'        => $this->request->getPost('alamat'),
            'deskripsi'     => $this->request->getPost('deskripsi'),
            'foto'          => $file_name
        ];

        if ($this->tempat->insert($data)) {
            $file->move('assets/img/tempat_magang', $file_name);
            return $this->response->setJSON([
                'success' => true,
                'status' => 200,
                'message' => 'Berhasil menambahkan tempat magang'
            ]);
        } else {
            return $this->response->setJSON([
                'success' => false,
                'status' => 500,
                'message' => $this->tempat->errors()
            ]);
        }
    }

    public function status_update()
    {
        if ($this->tempat->save([
            'id' => $this->request->getPost('item'),
            'status' => $this->request->getPost('status')
        ])) {
            return $this->response->setJSON([
                'success' => true,
                'status' => 200,
                'message' => 'Berhasil mengubah status tempat magang'
            ]);
        } else {
            return $this->response->setJSON([
                'success' => false,
                'status' => 500,
                'message' => $this->tempat->errors()
            ]);
        }
    }

    public function update()
    {
        $file = $this->request->getFile('foto');
        if ($file->getError() !== 0 || $file->getError() == 4) {
            $data = [
                'id'            => $this->request->getPost('item'),
                'pid'           => $this->request->getPost('pembimbing'),
                'nama'          => $this->request->getPost('nama'),
                'hp'            => $this->request->getPost('kontak'),
                'email'         => $this->request->getPost('email'),
                'kuota'         => $this->request->getPost('kuota'),
                'status'        => $this->request->getPost('status'),
                'alamat'        => $this->request->getPost('alamat'),
                'deskripsi'     => $this->request->getPost('deskripsi')
            ];
        } else {
            $file_name = $file->getRandomName();
            $data = [
                'id'            => $this->request->getPost('item'),
                'pid'           => $this->request->getPost('pembimbing'),
                'status'        => $this->request->getPost('status'),
                'kuota'         => $this->request->getPost('kuota'),
                'nama'          => $this->request->getPost('nama'),
                'hp'            => $this->request->getPost('kontak'),
                'email'         => $this->request->getPost('email'),
                'alamat'        => $this->request->getPost('alamat'),
                'deskripsi'     => $this->request->getPost('deskripsi'),
                'foto'          => $file_name
            ];
        } 

        if ($this->tempat->save($data)) {
            if ($file->getError() == 0) {
                $file->move('assets/img/tempat_magang', $file_name);
            }
            return $this->response->setJSON([
                'success' => true,
                'status' => 200,
                'message' => 'Berhasil mengubah tempat magang'
            ]);
        } else {
            return $this->response->setJSON([
                'success' => false,
                'status' => 500,
                'message' => $this->tempat->errors()
            ]);
        }

        return $this->response->setJSON($this->request->getPost());
    }

    public function destroy($id)
    {
        $foto = $this->tempat->find($id)->foto;
        if ($this->tempat->delete($id)) {
            unlink('assets/img/tempat_magang/' . $foto);
            return $this->response->setJSON([
                'status'    => 200,
                'success'   => true,
                'message'   => 'Tempat magang berhasil dihapus'
            ]);
        } else {
            return $this->response->setJSON([
                'status'    => 500,
                'success'   => false,
                'message'   => $this->tempat->errors()
            ]);
        }
    }
}

<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Nilai extends BaseController
{

    protected $nilai;

    public function __construct()
    {
        $this->nilai = new \App\Models\NilaiModel();
    }

    public function store()
    {
        $data = $this->request->getPost();
        if ($this->nilai->save($data)) {
            return $this->response->setJSON([
                'status'    => 200,
                'success'   => true,
                'message'   => 'Nilai siswa berhasil ditambahkan'
            ]);
        } else {
            return $this->response->setJSON([
                'status'    => 500,
                'success'   => false,
                'message'   => 'Nilai siswa gagal ditambahkan'
            ]);
        }
    }

    public function update()
    {
        $data = $this->request->getPost();
        if ($this->nilai->update($data['id'], $data)) {
            return $this->response->setJSON([
                'status'    => 200,
                'success'   => true,
                'message'   => 'Nilai siswa berhasil diubah'
            ]);
        } else {
            return $this->response->setJSON([
                'status'    => 500,
                'success'   => false,
                'message'   => 'Nilai siswa gagal diubah'
            ]);
        }
    }

    public function destroy($id)
    {
        if ($this->nilai->delete($id)) {
            return $this->response->setJSON([
                'status'    => 200,
                'success'   => true,
                'message'   => 'Nilai siswa berhasil dihapus'
            ]);
        } else {
            return $this->response->setJSON([
                'status'    => 500,
                'success'   => false,
                'message'   => 'Nilai siswa gagal dihapus'
            ]);
        }
    }
}

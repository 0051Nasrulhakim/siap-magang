<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Jurusan extends BaseController
{

    protected $jurusan;

    public function __construct() {
        $this->jurusan = new \App\Models\JurusanModel();
    }

    public function store()
    {
        if ($this->jurusan->save([
            'nama_jurusan' => $this->request->getPost('jurusan')
        ])) {
            return $this->response->setJSON([
                'status'    => 200,
                'success'   => true,
                'message'   => 'Jurusan berhasil ditambahkan'
            ]);
        } else {
            return $this->response->setJSON([
                'status'    => 500,
                'success'   => false,
                'message'   => 'Jurusan gagal ditambahkan'
            ]);
        }
    }

    public function destroy($id)
    {
        if ($this->jurusan->delete($id)) {
            return $this->response->setJSON([
                'status'    => 200,
                'success'   => true,
                'message'   => 'Jurusan berhasil dihapus'
            ]);
        } else {
            return $this->response->setJSON([
                'status'    => 500,
                'success'   => false,
                'message'   => 'Jurusan gagal dihapus'
            ]);
        }
    }

    public function update()
    {       
        if ($this->jurusan->save([
            'id'            => $this->request->getPost('ijurusan'),
            'nama_jurusan'  => $this->request->getPost('jurusan')
        ])) {
            return $this->response->setJSON([
                'status'    => 200,
                'success'   => true,
                'message'   => 'Jurusan berhasil diubah'
            ]);
        } else {
            return $this->response->setJSON([
                'status'    => 500,
                'success'   => false,
                'message'   => 'Jurusan gagal diubah'
            ]);
        }
    }
}

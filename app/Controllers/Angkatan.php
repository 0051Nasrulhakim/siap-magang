<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Angkatan extends BaseController
{

    protected $angkatan;

    public function __construct() {
        $this->angkatan = new \App\Models\AngkatanModel();
    }

    public function getAngkatan()
    {
        $angkatan = $this->angkatan->findAll();
        // make json id as value and nama - tahun as text
        $angkatan = array_map(function($item) {
            return [
                'value' => $item->nama . ' - ' . $item->tahun,
                'label' => $item->nama . ' - ' . $item->tahun,
                'no'    => $item->id,
                'tahun' => $item->tahun,
            ];
        }, $angkatan);

        return $this->response->setJSON($angkatan);
    }

    public function store()
    {
        if ($this->angkatan->save([
            'tahun' => $this->request->getPost('angkatan'),
            'nama' => $this->request->getPost('nama'),
            'tgl_mulai' => $this->request->getPost('mulai'),
            'tgl_selesai' => $this->request->getPost('selesai'),
        ])) {
            return $this->response->setJSON([
                'status'    => 200,
                'success'   => true,
                'message'   => 'Tahun angkatan berhasil ditambahkan'
            ]);
        } else {
            return $this->response->setJSON([
                'status'    => 500,
                'success'   => false,
                'message'   => 'Tahun angkatan gagal ditambahkan'
            ]);
        }
    }

    public function destroy($id)
    {
        if ($this->angkatan->delete($id)) {
            return $this->response->setJSON([
                'status'    => 200,
                'success'   => true,
                'message'   => 'Tahun angkatan berhasil dihapus'
            ]);
        } else {
            return $this->response->setJSON([
                'status'    => 500,
                'success'   => false,
                'message'   => implode(", ", $this->angkatan->errors())
            ]);
        }
    }
}

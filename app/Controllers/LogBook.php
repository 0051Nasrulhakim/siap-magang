<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class LogBook extends BaseController
{
    protected $logbooks;

    public function __construct()
    {
        $this->logbooks     = new \App\Models\LogBookModel();
    }

    public function store()
    {
        $data = [
            'id_siswa'      => $this->request->getPost('sid'),
            'id_tempat'     => $this->request->getPost('tid'),
            'id_pembimbing' => $this->request->getPost('pid'),
            'keterangan'    => $this->request->getPost('keterangan'),
            'tanggal'       => $this->request->getPost('tanggal'),
        ];

        // if keterangan is = hadir
        if ($data['keterangan'] == 'hadir') {
            $data['jam_masuk']  = $this->request->getPost('jam_masuk');
            $data['jam_keluar'] = $this->request->getPost('jam_keluar');
            $data['kegiatan']   = $this->request->getPost('kegiatan');
        }

        // insert data and return json
        if ($this->logbooks->insert($data)) {
            $response = [
                'success'   => true,
                'status'    => 200,
                'message'   => 'Data berhasil disimpan',
            ];
        } else {
            $response = [
                'success'   => false,
                'status'    => 500,
                'message'   => 'Data gagal disimpan',
            ];
        }

        return $this->response->setJSON($response);
    }

    public function status_update()
    {
        $data = [
            'id'            => $this->request->getPost('id'),
            'status'        => $this->request->getPost('status'),
        ];

        if ($this->logbooks->update($data['id'], $data)) {
            $response = [
                'success'   => true,
                'status'    => 200,
                'message'   => 'Status berhasil diubah',
            ];
        } else {
            $response = [
                'success'   => false,
                'status'    => 500,
                'message'   => 'Status gagal diubah',
            ];
        }

        return $this->response->setJSON($response);
    }
}

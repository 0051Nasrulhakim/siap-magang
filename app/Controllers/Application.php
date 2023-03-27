<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Application extends BaseController
{

    protected $app;

    public function __construct() {
        $this->app = new \App\Models\ApplicationModel();
    }

    public function daftar()
    {
        $data = [
            'id_siswa' => $this->request->getPost('uid'),
            'id_tempat' => $this->request->getPost('tid')
        ];

        if ($this->app->insert($data)) {
            return $this->response->setJSON([
                'status'    => 200,
                'success'   => true,
                'message'   => 'Permintaan magang berhasil diajukan'
            ]);
        } else {
            return $this->response->setJSON([
                'status'    => 500,
                'success'   => false,
                'message'   => $this->app->errors()
            ]);
        }        
    }

    public function destroy($id)
    {
        if ($this->app->delete($id)) {
            return $this->response->setJSON([
                'status'    => 200,
                'success'   => true,
                'message'   => 'Permintaan magang berhasil dihapus'
            ]);
        } else {
            return $this->response->setJSON([
                'status'    => 500,
                'success'   => false,
                'message'   => $this->app->errors()
            ]);
        }
    }

    public function update()
    {
        $data = $this->request->getPost();
        $id = $data['item'];
        unset($data['item']);


        if ($this->app->update($id, $data)) {
            return $this->response->setJSON([
                'status'    => 200,
                'success'   => true,
                'message'   => 'Permintaan magang berhasil diubah'
            ]);
        } else {
            return $this->response->setJSON([
                'status'    => 500,
                'success'   => false,
                'message'   => $this->app->errors()
            ]);
        }
    }
}

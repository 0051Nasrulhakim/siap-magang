<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Application extends BaseController
{

    protected $app;

    public function __construct()
    {
        $this->app = new \App\Models\ApplicationModel();
    }

    public function daftar()
    {
        $data = [
            'id_siswa' => $this->request->getPost('uid'),
            'id_tempat' => $this->request->getPost('tid')
        ];

        if (empty(getApplicationSiswa($data['id_siswa']))) {
            if (getSlotAvailable($data['id_tempat']) <= 0) {
                return $this->response->setJSON([
                    'status'    => 500,
                    'success'   => false,
                    'message'   => 'Kuota tempat magang sudah penuh'
                ]);
            } else {
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

        } {
            return $this->response->setJSON([
                'status'    => 500,
                'success'   => false,
                'message'   => 'Anda sudah pernah mengajukan permintaan magang'
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

        $id_siswa = $this->app->select('id_siswa')->where('id', $id)->first()->id_siswa;
        $id_tempat = $this->app->select('id_tempat')->where('id', $id)->first()->id_tempat;

        $accepted = $this->app->where('id_tempat', $id_tempat)->where('status', 'accepted')->findAll();

        if ($this->app->update($id, $data)) {
            
            if ($data['status'] == 'accepted') {
                $this->app->where('id_siswa', $id_siswa)->where('id !=', $id)->set(['status' => 'reject by system'])->update();

                $tempat = new \App\Models\TempatModel();
                $tempat = $tempat->find($id_tempat);

                if (count($accepted) >= $tempat->kuota) {
                    // $tempat->set(['status' => 'tutup'])->update(); /** status tempat jadi tutup */

                    $lam = $this->app->where('id_tempat', $id_tempat)->where('status', 'pending')->findAll();
                    foreach ($lam as $a) {
                        $this->app->update($a->id, ['status' => 'reject by system']);
                    }
                }
            }
            
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

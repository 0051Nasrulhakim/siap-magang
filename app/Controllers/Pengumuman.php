<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Pengumuman extends BaseController
{
    protected $pengumuman;

    public function __construct()
    {
        $this->pengumuman = new \App\Models\PengumumanModel();
    }

    public function get($id)
    {
        $pengumuman = $this->pengumuman->select('pengumuman.*, pembimbing.nama as pembimbing')
            ->join('pembimbing', 'pembimbing.id = pengumuman.oleh')
            ->where('pengumuman.id', $id)
            ->first();

        return $this->response->setJSON($pengumuman);
    }

    public function store()
    {
        $lampiran = $this->request->getFile('file');
        
        $data = [
            'judul' => $this->request->getPost('judul'),
            'isi' => $this->request->getPost('keterangan'),
            'oleh' => $this->request->getPost('oid'),
        ];

        if ($lampiran !== null) {
            if($lampiran->isValid()){
                $lampiran_name = $lampiran->getRandomName();
                $data['lampiran'] = $lampiran_name;
            }
        }
        
        if ($this->pengumuman->save($data)) {
            if ($lampiran !== null) {
                if($lampiran->isValid()){
                    $lampiran->move('assets/lampiran', $lampiran_name);
                }
            }

            return $this->response->setJSON([
                'success' => true,
                'status' => 200,
                'message' => 'Berhasil menambahkan pengumuman'
            ]);
        } else {
            return $this->response->setJSON([
                'success' => false,
                'status' => 500,
                'message' => $this->pengumuman->errors()
            ]);
        }
    }

    public function destroy($id = null)
    {
        // if id not null
        if ($id !== null) {
            $pengumuman = $this->pengumuman->find($id);

            if ($pengumuman) {
                if ($this->pengumuman->delete($id)) {
                    return $this->response->setJSON([
                        'success' => true,
                        'status' => 200,
                        'message' => 'Berhasil menghapus pengumuman'
                    ]);
                } else {
                    return $this->response->setJSON([
                        'success' => false,
                        'status' => 500,
                        'message' => $this->pengumuman->errors()
                    ]);
                }
            } else {
                return $this->response->setJSON([
                    'success' => false,
                    'status' => 404,
                    'message' => 'Pengumuman tidak ditemukan'
                ]);
            }
        }
    }
}

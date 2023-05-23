<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class LogBook extends BaseController
{
    protected $logbooks;
    protected $validation;
    protected $rules;

    public function __construct()
    {
        $this->logbooks     = new \App\Models\LogBookModel();
        $this->validation   = \Config\Services::validation();
    }

    public function store()
    {
        $bukti      = $this->request->getFile('bukti');
        $filename   = $bukti->getRandomName();

        $data = [
            'id_siswa'      => $this->request->getPost('sid'),
            'id_tempat'     => $this->request->getPost('tid'),
            'id_pembimbing' => $this->request->getPost('pid'),
            'keterangan'    => $this->request->getPost('keterangan'),
            'tanggal'       => $this->request->getPost('tanggal'),
        ];

        $file_rules = 'required|uploaded[bukti]|max_size[bukti,10240]|ext_in[bukti,png,jpg,jpeg]';
        if (!$this->validation->check($bukti, $file_rules)) {
            return $this->response->setJSON([
                'success'   => false,
                'status'    => 500,
                'message'   => "Bukti tidak valid, pastikan ukuran file tidak lebih dari 10MB dan format file adalah png, jpg, atau jpeg"
            ]);
        }

        $data['bukti'] = $filename;
        
        // rule for all data without bukti
        $rules = [
            'id_siswa'      => 'required|numeric',
            'id_tempat'     => 'required|numeric',
            'id_pembimbing' => 'required|numeric',
            'keterangan'    => 'required|in_list[hadir,izin,sakit,alfa]',
            'tanggal'       => 'required|valid_date[Y-m-d]',
        ];
        
        // if keterangan is = hadir
        if ($data['keterangan'] == 'hadir') {
            $data['jam_masuk']  = $this->request->getPost('jam_masuk');
            $data['jam_keluar'] = $this->request->getPost('jam_keluar');
            $data['kegiatan']   = $this->request->getPost('kegiatan');

            $this->rules['jam_masuk']   = 'required|valid_time';
            $this->rules['jam_keluar']  = 'required|valid_time';
            $this->rules['kegiatan']    = 'required|alpha_numeric_punct|min_length[20]';
        }

        if ($this->request->getPost('lid') !== null) {
            $data['id'] = $this->request->getPost('lid');
            $data['status'] = 'pending';
        } else {
            if ($this->logbooks->where([
                'tanggal'       => $data['tanggal'],
                'id_siswa'      => $data['id_siswa'],
                'id_tempat'     => $data['id_tempat'],
                'id_pembimbing' => $data['id_pembimbing'],
            ])->first() !== null) {
                return $this->response->setJSON([
                    'success'   => false,
                    'status'    => 500,
                    'message'   => 'Logbook pada tanggal tersebut sudah ada',
                ]);
            }
        }

        // validate all data without bukti
        $this->validation->setRules($rules);
        if (!$this->validation->run($data)) {
            return $this->response->setJSON([
                'success'   => false,
                'status'    => 500,
                'message'   => "Data tidak valid, pastikan semua data terisi dengan benar"
            ]);
        }

        if ($this->logbooks->save($data)) {
            $bukti->move('assets/img/logbook', $filename);
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

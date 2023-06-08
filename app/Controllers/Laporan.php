<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Laporan extends BaseController
{

    protected $angkatan, $jurusan, $siswa, $application, $tempat;

    public function __construct()
    {
        $this->angkatan = new \App\Models\AngkatanModel();
        $this->jurusan = new \App\Models\JurusanModel();
        $this->siswa = new \App\Models\SiswaModel();
        $this->application = new \App\Models\ApplicationModel();
        $this->tempat = new \App\Models\TempatModel();
    }

    public function index()
    {
        $angkatan = $this->request->getVar('angkatan');
        $jurusan = $this->request->getVar('jurusan');
        $tahun = $this->request->getVar('tahun');

        if ($jurusan != '') {
            $jurusan = "XI " . $jurusan;
        }

        $data = $this->application->select('lamaran.status, siswa.nis, siswa.nama, siswa.kelas, siswa.laporan, angkatan.tahun, angkatan.tgl_selesai, angkatan.nama as angkatan, pembimbing.nama as nama_pembimbing')
            ->join('siswa', 'siswa.id = lamaran.id_siswa')
            ->join('angkatan', 'angkatan.id = siswa.angkatan')
            ->join('tempat_magang', 'tempat_magang.id = lamaran.id_tempat')
            ->join('pembimbing', 'pembimbing.id = tempat_magang.pid')
            ->where($tahun !== "" ? ['angkatan.tahun' => $tahun] : [])
            ->where($angkatan !== "" ? ['angkatan.nama' => $angkatan] : []) 
            ->where($jurusan !== "" ? ['siswa.kelas' => $jurusan] : [])
            ->orderBy('siswa.nis', 'ASC')
            ->findAll();

        // count kelas with same name from data
        $kelas = array_count_values(array_column($data, 'kelas'));
        $status = [];
        foreach ($data as $d) {
            if ($d->laporan == null && date("Y-m-d") > $d->tgl_selesai) {
                $status[] = 'unfinished';
            } else {
                $status[] = strtolower($d->status) == 'selesai' ? 'finished' : strtolower($d->status);
            }
        }
        $status = array_count_values($status);

        return view('laporan_show', [
            'data'              => $data,
            'angkatan_selected' => $angkatan,
            'jurusan_selected'  => $jurusan,
            'tahun_selected'    => $tahun,
            'tahun'             => $this->angkatan->groupBy('tahun')->findAll(),
            'jml_siswa'         => count($data),
            'kelas'             => $kelas,
            'status'             => $status
        ]);
    }
}

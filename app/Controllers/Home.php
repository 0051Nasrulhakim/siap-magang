<?php

namespace App\Controllers;

class Home extends BaseController
{

    protected $angkatan;
    protected $jurusan;
    protected $user;
    protected $siswa;
    protected $tempat;
    protected $application;
    protected $pembimbing;

    public function __construct() {
        $this->angkatan     = new \App\Models\AngkatanModel();
        $this->jurusan      = new \App\Models\JurusanModel();
        $this->user         = new \App\Models\UserModel();
        $this->siswa        = new \App\Models\SiswaModel();
        $this->tempat       = new \App\Models\TempatModel();
        $this->application  = new \App\Models\ApplicationModel();
        $this->pembimbing   = new \App\Models\PembimbingModel();
    }

    public function index()
    {
        return view('admin/dashboard', [
            "title"         => "Magang | Dashboard",
            "page_title"    => "Dashboard",
            "segment"       => $this->request->getUri()->getSegments(),
            "breadcrumb"    => ['Dashboard']
        ]);
    }

    public function tempat()
    {
        return view('admin/tempat', [
            "title"         => "Magang | Tempat Magang",
            "page_title"    => "Daftar Tempat Magang",
            "segment"       => $this->request->getUri()->getSegments(),
            "breadcrumb"    => ['Tempat Magang'],
            "tempat"        => $this->tempat->orderBy("status", "ASC")->findAll()
        ]);
    }

    public function application()
    {
        $dapp = $this->application->select('lamaran.*, siswa.nama, siswa.nis, siswa.kelas, siswa.no_hp, siswa.alamat, angkatan.tahun')
            ->join('siswa', 'siswa.id = lamaran.id_siswa')
            ->join('angkatan', 'angkatan.id = siswa.angkatan')
            ->orderBy('lamaran.created_at', "DESC")
            ->findAll();
        // dd($dapp);

        return view('admin/application', [
            "title"         => "Magang | Application Siswa",
            "page_title"    => "Lamaran Siswa Magang",
            "segment"       => $this->request->getUri()->getSegments(),
            "breadcrumb"    => ['Application'],
            "applications"  => $dapp
        ]);
    }

    public function man_tempat()
    {
        return view('admin/man_tempat', [
            "title"         => "Magang | Manajemen Tempat",
            "page_title"    => "Manejemen Tempat Magang",
            "segment"       => $this->request->getUri()->getSegments(),
            "breadcrumb"    => ['Manajemen', 'Tempat'],
            "tempat"        => $this->tempat->findAll(),
            "pembimbing"    => $this->pembimbing->findAll()
        ]);
    }

    public function tempat_edit($id)
    {
        return view('admin/edit_tempat', [
            'title'         => 'Magang | Edit Tempat Magang',
            'page_title'    => 'Edit Tempat Magang',
            'segment'       => $this->request->getUri()->getSegments(),
            'breadcrumb'    => ['Manajemen', 'Tempat', 'Edit'],
            'tempat'        => $this->tempat->find($id),
            'pembimbing'    => $this->pembimbing->findAll()
        ]);
    }

    public function man_user()
    {
        $duser = $this->user
            ->select('users.id, users.username, users.email')
            ->select('pembimbing.id as pid, pembimbing.nama, pembimbing.no_hp')
            ->join('pembimbing', 'pembimbing.user_id = users.id')
            ->findAll();

        return view('admin/man_user', [
            "title"         => "Magang | Manajemen User",
            "page_title"    => "Manajejemen Data Pengelola dan Guru",
            "segment"       => $this->request->getUri()->getSegments(),
            "breadcrumb"    => ['Manajemen', 'User'],
            "user"          => $duser
        ]);
    }

    public function man_siswa()
    {
        $dsiswa = $this->user
            ->select('users.id, users.username, users.email, siswa.nis, siswa.nama, siswa.kelas, siswa.no_hp, siswa.alamat, angkatan.tahun as angkatan')
            ->join('siswa', 'siswa.user_id = users.id', 'inner')
            ->join('angkatan', 'angkatan.id = siswa.angkatan', "inner")
            ->findAll();

        return view('admin/man_siswa', [
            "title"         => "Magang | Manajemen Siswa",
            "page_title"    => "Manajemen Data Siswa",
            "segment"       => $this->request->getUri()->getSegments(),
            "breadcrumb"    => ['Manajemen', 'Siswa'],
            "angkatan"      => $this->angkatan->findAll(),
            "jurusan"       => $this->jurusan->findAll(),
            "siswa"         => $dsiswa
        ]);
    }

    public function siswa_edit($nis)
    {
        $nis = substr($nis, 0, 2) . '.' . substr($nis, 2);
        $dsiswa = $this->user
            ->select('users.id, users.username, users.email, siswa.nis, siswa.nama, siswa.kelas, siswa.no_hp, siswa.alamat, angkatan.tahun as angkatan')
            ->join('siswa', 'siswa.user_id = users.id', 'inner')
            ->join('angkatan', 'angkatan.id = siswa.angkatan', "inner")
            ->where('siswa.nis', $nis)
            ->first();

        return view('admin/edit_siswa', [
            "title"         => "Magang | Edit Data siswa",
            "page_title"    => "Edit Data Siswa $nis",
            "segment"       => $this->request->getUri()->getSegments(),
            "breadcrumb"    => ['Siswa','Edit', $nis],
            "siswa"         => $dsiswa,
            "angkatan"      => $this->angkatan->findAll(),
            "jurusan"       => $this->jurusan->findAll()
        ]);
    }

    public function settings()
    {
        return view('admin/settings', [
            "title"         => "Magang | Site Settings",
            "page_title"    => "Pengaturan",
            "segment"       => $this->request->getUri()->getSegments(),
            "breadcrumb"    => ['Settings'],
            "angkatan"      => $this->angkatan->findAll(),
            "jurusan"       => $this->jurusan->findAll()
        ]);
    }
}

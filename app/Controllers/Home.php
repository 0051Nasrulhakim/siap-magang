<?php

namespace App\Controllers;

class Home extends BaseController
{

    protected $angkatan;
    protected $jurusan;
    protected $user;
    protected $siswa;

    public function __construct() {
        $this->angkatan     = new \App\Models\AngkatanModel();
        $this->jurusan      = new \App\Models\JurusanModel();
        $this->user         = new \App\Models\UserModel();
        $this->siswa        = new \App\Models\SiswaModel();
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
            "breadcrumb"    => ['Tempat Magang']
        ]);
    }

    public function application()
    {
        return view('admin/application', [
            "title"         => "Magang | Application Siswa",
            "page_title"    => "Lamaran Siswa Magang",
            "segment"       => $this->request->getUri()->getSegments(),
            "breadcrumb"    => ['Application']
        ]);
    }

    public function man_tempat()
    {
        return view('admin/man_tempat', [
            "title"         => "Magang | Manajemen Tempat",
            "page_title"    => "Manejemen Tempat Magang",
            "segment"       => $this->request->getUri()->getSegments(),
            "breadcrumb"    => ['Manajemen', 'Tempat']
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

    public function user_edit($uname)
    {
        return view('admin/siswa_edit', [
            "title"         => "Magang | Edit Data siswa",
            "page_title"    => "Edit Data User $uname",
            "segment"       => $this->request->getUri()->getSegments(),
            "breadcrumb"    => ['Siswa','Edit', $uname],
            "siswa"         => $this->user->where('username', $uname)->join('angkatan', 'angkatan.id = users.angkatan')->first(),
            "angkatan"      => $this->angkatan->findAll(),
            "jurusan"       => $this->jurusan->findAll()
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

        return view('admin/siswa_edit', [
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
